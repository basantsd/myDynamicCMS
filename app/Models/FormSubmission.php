<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'form_name',  // Keep for backward compatibility
        'form_type',
        'form_data',
        'calculated_result',
        'page_id',
        'page_section_id',
        'data',
        'ip_address',
        'user_agent',
        'user_id',
        'submitted_at',
    ];

    protected $casts = [
        'data' => 'array',
        'form_data' => 'array',
        'calculated_result' => 'array',
        'submitted_at' => 'datetime',
    ];

    /**
     * Default ordering
     */
    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    /**
     * Get the form that owns the submission
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get the page that owns the submission
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the page section that owns the submission
     */
    public function pageSection(): BelongsTo
    {
        return $this->belongsTo(PageSection::class);
    }

    /**
     * Get the user who submitted the form
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter by form name
     */
    public function scopeByFormName(Builder $query, string $formName): Builder
    {
        return $query->where('form_name', $formName);
    }

    /**
     * Scope to filter by form type
     */
    public function scopeSubmissionType(Builder $query): Builder
    {
        return $query->where('form_type', 'submission');
    }

    /**
     * Scope to filter calculation type
     */
    public function scopeCalculationType(Builder $query): Builder
    {
        return $query->where('form_type', 'calculation');
    }

    /**
     * Scope to filter action type
     */
    public function scopeActionType(Builder $query): Builder
    {
        return $query->where('form_type', 'action');
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('submitted_at', [$startDate, $endDate]);
    }

    /**
     * Get formatted submission data
     */
    public function getFormattedDataAttribute(): array
    {
        // Prefer form_data over data for new submissions
        $data = $this->form_data ?? $this->data ?? [];

        if (empty($data)) {
            return [];
        }

        return $data;
    }

    /**
     * Get display name for the form
     */
    public function getFormDisplayNameAttribute(): string
    {
        if ($this->form) {
            return $this->form->name;
        }

        return $this->form_name ?? 'Unknown Form';
    }

    /**
     * Get cleaned form data (without technical fields)
     */
    public function getCleanedDataAttribute(): array
    {
        $data = $this->formatted_data;

        // Remove technical/hidden fields
        $fieldsToRemove = ['_token', 'form_id', '_method', 'csrf_token'];

        foreach ($fieldsToRemove as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    /**
     * Get form data with proper labels
     */
    public function getLabeledDataAttribute(): array
    {
        $cleanedData = $this->cleaned_data;
        $labeledData = [];

        foreach ($cleanedData as $key => $value) {
            // Convert snake_case and camelCase to Title Case
            $label = str_replace('_', ' ', $key);
            $label = ucwords(strtolower($label));

            $labeledData[$label] = $value;
        }

        return $labeledData;
    }
}
