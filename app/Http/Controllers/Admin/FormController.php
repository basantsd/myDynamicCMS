<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::ordered()->paginate(20);
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'form_type' => 'required|in:submission,calculation,action',
            'submission_endpoint' => 'nullable|string',
            'success_message' => 'nullable|string',
            'error_message' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'fields' => 'required|array',
            'calculation_config' => 'nullable|array',
            'action_config' => 'nullable|array',
            'layout' => 'nullable|in:centered,left,right,split,inline',
            'submit_button_text' => 'nullable|string',
            'submit_button_style' => 'nullable|string',
            'form_width' => 'nullable|string',
            'background_color' => 'nullable|string',
            'send_email_notification' => 'boolean',
            'notification_email' => 'nullable|email',
            'notification_subject' => 'nullable|string',
            'notification_template' => 'nullable|string',
            'send_auto_response' => 'boolean',
            'auto_response_subject' => 'nullable|string',
            'auto_response_template' => 'nullable|string',
            'auto_response_email_field' => 'nullable|string',
            'store_submissions' => 'boolean',
            'enable_captcha' => 'boolean',
            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $form = Form::create($validated);

        return redirect()->route('admin.forms.index')
            ->with('success', 'Form created successfully');
    }

    public function edit(Form $form)
    {
        return view('admin.forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'form_type' => 'required|in:submission,calculation,action',
            'submission_endpoint' => 'nullable|string',
            'success_message' => 'nullable|string',
            'error_message' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'fields' => 'required|array',
            'calculation_config' => 'nullable|array',
            'action_config' => 'nullable|array',
            'layout' => 'nullable|in:centered,left,right,split,inline',
            'submit_button_text' => 'nullable|string',
            'submit_button_style' => 'nullable|string',
            'form_width' => 'nullable|string',
            'background_color' => 'nullable|string',
            'send_email_notification' => 'boolean',
            'notification_email' => 'nullable|email',
            'notification_subject' => 'nullable|string',
            'notification_template' => 'nullable|string',
            'send_auto_response' => 'boolean',
            'auto_response_subject' => 'nullable|string',
            'auto_response_template' => 'nullable|string',
            'auto_response_email_field' => 'nullable|string',
            'store_submissions' => 'boolean',
            'enable_captcha' => 'boolean',
            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $form->update($validated);

        return redirect()->route('admin.forms.index')
            ->with('success', 'Form updated successfully');
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('admin.forms.index')
            ->with('success', 'Form deleted successfully');
    }

    public function list()
    {
        $forms = Form::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'forms' => $forms->map(function ($form) {
                return [
                    'id' => $form->id,
                    'name' => $form->name,
                    'title' => $form->title,
                    'form_type' => $form->form_type,
                    'html' => $form->generateHtml(),
                ];
            }),
        ]);
    }

    public function submissions(Form $form)
    {
        $submissions = $form->submissions()->latest()->paginate(50);
        return view('admin.forms.submissions', compact('form', 'submissions'));
    }

    public function submit(Request $request)
    {
        $formId = $request->input('form_id');
        $form = Form::findOrFail($formId);

        // Validate based on form fields
        $rules = [];
        foreach ($form->fields as $field) {
            if (!empty($field['validation'])) {
                $rules[$field['name']] = $field['validation'];
            } elseif ($field['required'] ?? false) {
                $rules[$field['name']] = 'required';
            }
        }

        $validated = $request->validate($rules);

        // Only store submission if enabled AND form type is 'submission' (not calculation)
        if ($form->store_submissions && $form->form_type === 'submission') {
            FormSubmission::create([
                'form_id' => $form->id,
                'form_name' => $form->name,  // For backward compatibility
                'form_type' => $form->form_type,
                'form_data' => $validated,
                'data' => $validated,  // Keep for backward compatibility
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'user_id' => auth()->id(),
                'submitted_at' => now(),
            ]);
        }

        // Send email notification if enabled
        if ($form->send_email_notification && $form->notification_email) {
            // TODO: Implement email notification
        }

        // Send auto-response if enabled
        if ($form->send_auto_response && $form->auto_response_email_field) {
            // TODO: Implement auto-response
        }

        return response()->json([
            'success' => true,
            'message' => $form->success_message,
            'redirect' => $form->redirect_url,
        ]);
    }
}
