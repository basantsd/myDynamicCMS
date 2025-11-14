<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormSubmissionController extends Controller
{
    /**
     * Display all form submissions with filters
     */
    public function index(Request $request)
    {
        $query = FormSubmission::with(['form', 'page', 'pageSection', 'user']);

        // Filter by form type
        if ($request->has('form_type') && $request->form_type) {
            $query->where('form_type', $request->form_type);
        }

        // Filter by form ID
        if ($request->has('form_id') && $request->form_id) {
            $query->where('form_id', $request->form_id);
        }

        // Filter by form name (backward compatibility)
        if ($request->has('form_name') && $request->form_name) {
            $query->byFormName($request->form_name);
        }

        // Filter by page
        if ($request->has('page_id') && $request->page_id) {
            $query->where('page_id', $request->page_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Global scope already orders by created_at desc, but we can override with submitted_at
        $submissions = $query->orderBy('submitted_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total' => FormSubmission::count(),
            'submission_type' => FormSubmission::submissionType()->count(),
            'calculation_type' => FormSubmission::calculationType()->count(),
            'action_type' => FormSubmission::actionType()->count(),
        ];

        // Get all forms for filter
        $forms = \App\Models\Form::orderBy('name')->get();

        // Get unique form names for filter (backward compatibility)
        $formNames = FormSubmission::distinct()->pluck('form_name')->filter();

        // Get all pages for filter
        $pages = Page::orderBy('title')->get();

        return view('admin.form-submissions.index', compact('submissions', 'stats', 'forms', 'formNames', 'pages'));
    }

    /**
     * Show a single submission
     */
    public function show($id)
    {
        $submission = FormSubmission::with(['form', 'page', 'pageSection', 'user'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'submission' => $submission,
            'formatted_data' => $submission->formatted_data,
        ]);
    }

    /**
     * Submit a form (public endpoint)
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_id' => 'nullable|exists:pages,id',
            'page_section_id' => 'nullable|exists:page_sections,id',
            'form_name' => 'required|string',
            'form_type' => 'required|in:submission,calculation,action',
            'form_data' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Process calculation-based forms
        $calculatedResult = null;
        if ($request->form_type === 'calculation') {
            $calculatedResult = $this->processCalculation($request->form_data);
        }

        // Process action-based forms
        if ($request->form_type === 'action') {
            $actionResult = $this->processAction($request->form_data);
            $calculatedResult = $actionResult;
        }

        $submission = FormSubmission::create([
            'page_id' => $request->page_id,
            'page_section_id' => $request->page_section_id,
            'form_name' => $request->form_name,
            'form_type' => $request->form_type,
            'form_data' => $request->form_data,
            'calculated_result' => $calculatedResult,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'submitted_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully',
            'submission' => $submission,
            'calculated_result' => $calculatedResult,
        ]);
    }

    /**
     * Get submissions for a specific form
     */
    public function getByForm(Request $request, $formName)
    {
        $submissions = FormSubmission::with(['form', 'user'])
            ->byFormName($formName)
            ->orderBy('submitted_at', 'desc')
            ->paginate(50);

        return response()->json([
            'success' => true,
            'form_name' => $formName,
            'submissions' => $submissions,
        ]);
    }

    /**
     * Export form submissions as CSV
     */
    public function export(Request $request, $formName)
    {
        $submissions = FormSubmission::byFormName($formName)
            ->orderBy('submitted_at', 'asc')
            ->get();

        if ($submissions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No submissions found for this form',
            ], 404);
        }

        // Extract headers from first submission
        $firstSubmission = $submissions->first();
        $formData = $firstSubmission->formatted_data;
        $headers = array_keys($formData);
        array_unshift($headers, 'ID', 'Submitted At', 'IP Address');

        // Build CSV content
        $csvContent = implode(',', array_map(function($header) {
            return '"' . str_replace('"', '""', $header) . '"';
        }, $headers)) . "\n";

        foreach ($submissions as $submission) {
            $row = [
                $submission->id,
                $submission->submitted_at->format('Y-m-d H:i:s'),
                $submission->ip_address,
            ];

            foreach ($submission->formatted_data as $value) {
                // Handle arrays/objects
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $row[] = '"' . str_replace('"', '""', (string)$value) . '"';
            }

            $csvContent .= implode(',', $row) . "\n";
        }

        return response($csvContent, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $formName . '-submissions.csv"');
    }

    /**
     * Delete a submission
     */
    public function destroy($id)
    {
        $submission = FormSubmission::findOrFail($id);
        $submission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Submission deleted successfully',
        ]);
    }

    /**
     * Get submission statistics
     */
    public function statistics(Request $request)
    {
        $stats = [
            'total_submissions' => FormSubmission::count(),
            'by_type' => [
                'submission' => FormSubmission::submissionType()->count(),
                'calculation' => FormSubmission::calculationType()->count(),
                'action' => FormSubmission::actionType()->count(),
            ],
            'today' => FormSubmission::whereDate('submitted_at', today())->count(),
            'this_week' => FormSubmission::whereBetween('submitted_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => FormSubmission::whereMonth('submitted_at', now()->month)->count(),
        ];

        // Get form-wise breakdown
        $formWise = FormSubmission::selectRaw('form_name, form_type, COUNT(*) as count')
            ->groupBy('form_name', 'form_type')
            ->get();

        $stats['by_form'] = $formWise;

        return response()->json([
            'success' => true,
            'statistics' => $stats,
        ]);
    }

    /**
     * Process calculations for calculation-based forms
     */
    private function processCalculation($formData)
    {
        // Example: Simple arithmetic calculations
        $result = [];

        // Check if there's a calculation formula in the data
        if (isset($formData['calculation_type'])) {
            switch ($formData['calculation_type']) {
                case 'sum':
                    $result['total'] = array_sum(array_filter($formData, 'is_numeric'));
                    break;
                case 'average':
                    $numbers = array_filter($formData, 'is_numeric');
                    $result['average'] = count($numbers) > 0 ? array_sum($numbers) / count($numbers) : 0;
                    break;
                case 'percentage':
                    if (isset($formData['value']) && isset($formData['total'])) {
                        $result['percentage'] = ($formData['value'] / $formData['total']) * 100;
                    }
                    break;
                // Add more calculation types as needed
            }
        }

        return $result;
    }

    /**
     * Process actions for action-based forms
     */
    private function processAction($formData)
    {
        // Handle different action types
        $result = [
            'action_performed' => true,
            'timestamp' => now()->toIso8601String(),
        ];

        if (isset($formData['action_type'])) {
            $result['action_type'] = $formData['action_type'];
        }

        return $result;
    }
}
