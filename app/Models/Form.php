<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'form_type',
        'submission_endpoint',
        'success_message',
        'error_message',
        'redirect_url',
        'fields',
        'calculation_config',
        'action_config',
        'layout',
        'submit_button_text',
        'submit_button_style',
        'form_width',
        'background_color',
        'send_email_notification',
        'notification_email',
        'notification_subject',
        'notification_template',
        'send_auto_response',
        'auto_response_subject',
        'auto_response_template',
        'auto_response_email_field',
        'store_submissions',
        'enable_captcha',
        'custom_css',
        'custom_js',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'fields' => 'array',
        'calculation_config' => 'array',
        'action_config' => 'array',
        'send_email_notification' => 'boolean',
        'send_auto_response' => 'boolean',
        'store_submissions' => 'boolean',
        'enable_captcha' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get form submissions
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    /**
     * Get active forms
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get forms ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Generate HTML for the form
     */
    public function generateHtml(): string
    {
        $formId = 'form-' . $this->id;
        $action = $this->submission_endpoint ?? '/api/form-submit';

        $layoutClass = match($this->layout) {
            'centered' => 'col-lg-6 mx-auto',
            'left' => 'col-lg-8',
            'right' => 'col-lg-8 ms-auto',
            'split' => 'col-lg-6',
            'inline' => 'col-12',
            default => 'col-lg-6 mx-auto',
        };

        $fieldsHtml = '';
        foreach ($this->fields as $field) {
            $fieldsHtml .= $this->generateFieldHtml($field);
        }

        // Add calculation script if form type is calculation
        $calculationScript = '';
        if ($this->form_type === 'calculation' && !empty($this->calculation_config)) {
            $calculationScript = $this->generateCalculationScript();
        }

        return <<<HTML
        <section class="form-section" style="padding: 80px 0; background: {$this->background_color};">
            <div class="container">
                <div class="row">
                    <div class="{$layoutClass}">
                        <div class="text-center mb-4">
                            <h2 style="font-size: 36px; font-weight: bold;">{$this->title}</h2>
                            <p style="font-size: 18px; color: #666;">{$this->description}</p>
                        </div>
                        <form id="{$formId}" action="{$action}" method="POST" data-form-type="{$this->form_type}" data-form-id="{$this->id}" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <input type="hidden" name="form_id" value="{$this->id}">
                            {$fieldsHtml}
                            <button type="submit" class="btn btn-{$this->submit_button_style} btn-lg w-100" style="padding: 12px;">{$this->submit_button_text}</button>
                        </form>
                        <div id="{$formId}-result" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
            {$calculationScript}
        </section>
        HTML;
    }

    private function generateFieldHtml(array $field): string
    {
        $required = $field['required'] ?? false;
        $requiredAttr = $required ? 'required' : '';
        $requiredLabel = $required ? '<span class="text-danger">*</span>' : '';
        $fieldName = $field['name'] ?? '';
        $fieldType = $field['type'] ?? 'text';
        $label = $field['label'] ?? ucfirst($fieldName);
        $placeholder = $field['placeholder'] ?? '';
        $defaultValue = $field['default_value'] ?? '';
        $helpText = $field['help_text'] ?? '';

        $html = "<div class='mb-3'>";
        $html .= "<label class='form-label'>{$label} {$requiredLabel}</label>";

        switch ($fieldType) {
            case 'textarea':
                $html .= "<textarea class='form-control' name='{$fieldName}' placeholder='{$placeholder}' {$requiredAttr} style='padding: 12px;'>{$defaultValue}</textarea>";
                break;

            case 'select':
                $options = $field['options'] ?? [];
                $html .= "<select class='form-select' name='{$fieldName}' {$requiredAttr} style='padding: 12px;'>";
                $html .= "<option value=''>Select...</option>";
                foreach ($options as $option) {
                    $selected = $option === $defaultValue ? 'selected' : '';
                    $html .= "<option value='{$option}' {$selected}>{$option}</option>";
                }
                $html .= "</select>";
                break;

            case 'checkbox':
                $checked = $defaultValue ? 'checked' : '';
                $html .= "<div class='form-check'>";
                $html .= "<input class='form-check-input' type='checkbox' name='{$fieldName}' value='1' {$checked} {$requiredAttr}>";
                $html .= "<label class='form-check-label'>{$placeholder}</label>";
                $html .= "</div>";
                break;

            case 'radio':
                $options = $field['options'] ?? [];
                foreach ($options as $option) {
                    $checked = $option === $defaultValue ? 'checked' : '';
                    $html .= "<div class='form-check'>";
                    $html .= "<input class='form-check-input' type='radio' name='{$fieldName}' value='{$option}' {$checked} {$requiredAttr}>";
                    $html .= "<label class='form-check-label'>{$option}</label>";
                    $html .= "</div>";
                }
                break;

            case 'file':
                $accept = $field['accept'] ?? '*/*';
                $html .= "<input type='file' class='form-control' name='{$fieldName}' accept='{$accept}' {$requiredAttr}>";
                break;

            case 'number':
                $min = $field['min'] ?? '';
                $max = $field['max'] ?? '';
                $step = $field['step'] ?? '1';
                $html .= "<input type='number' class='form-control calculation-field' name='{$fieldName}' placeholder='{$placeholder}' value='{$defaultValue}' min='{$min}' max='{$max}' step='{$step}' {$requiredAttr} style='padding: 12px;'>";
                break;

            default:
                $html .= "<input type='{$fieldType}' class='form-control' name='{$fieldName}' placeholder='{$placeholder}' value='{$defaultValue}' {$requiredAttr} style='padding: 12px;'>";
                break;
        }

        if ($helpText) {
            $html .= "<small class='form-text text-muted'>{$helpText}</small>";
        }

        $html .= "</div>";

        return $html;
    }

    private function generateCalculationScript(): string
    {
        $config = $this->calculation_config;
        $formula = $config['custom_formula'] ?? '';
        $resultField = $config['result_field'] ?? 'result';
        $calculationType = $config['calculation_type'] ?? 'custom';

        if ($calculationType === 'sum') {
            $fields = $config['fields_to_calculate'] ?? [];
            $formula = implode(' + ', array_map(fn($f) => "parseFloat(field_{$f}.value || 0)", $fields));
        } elseif ($calculationType === 'average') {
            $fields = $config['fields_to_calculate'] ?? [];
            $sum = implode(' + ', array_map(fn($f) => "parseFloat(field_{$f}.value || 0)", $fields));
            $formula = "({$sum}) / " . count($fields);
        }

        return <<<HTML
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-{$this->id}');
            const calculationFields = form.querySelectorAll('.calculation-field');
            const resultField = form.querySelector('[name="{$resultField}"]');

            function calculate() {
                try {
                    const result = {$formula};
                    if (resultField) {
                        resultField.value = result.toFixed(2);
                    }
                } catch (e) {
                    console.error('Calculation error:', e);
                }
            }

            calculationFields.forEach(field => {
                field.addEventListener('input', calculate);
            });

            calculate(); // Initial calculation
        });
        </script>
        HTML;
    }
}
