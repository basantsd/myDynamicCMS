<?php

namespace App\Http\Controllers;

use App\Models\CustomBlock;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'section_type' => 'required',
            'name' => 'nullable|string|max:255',
            'custom_block_id' => 'nullable|exists:custom_blocks,id',
            'content' => 'required|array',
        ]);

        $content = $request->content;

        // If custom block is specified, increment its usage count and merge defaults
        if ($request->custom_block_id) {
            $customBlock = CustomBlock::find($request->custom_block_id);
            if ($customBlock) {
                $customBlock->incrementUsage();
                $content = array_merge($customBlock->default_values ?? [], $content);
            }
        }

        // Handle file uploads for various image fields
        $imageFields = ['background_image', 'image', 'avatar', 'photo', 'thumbnail'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('sections', $filename, 'public');
                $content[$field] = $path;
            }
        }

        // Handle multiple file uploads (for gallery, team members, etc.)
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('sections', $filename, 'public');
                $images[] = $path;
            }
            $content['images'] = $images;
        }

        $section = PageSection::create([
            'page_id' => $request->page_id,
            'section_type' => $request->section_type,
            'name' => $request->name,
            'custom_block_id' => $request->custom_block_id,
            'order' => PageSection::where('page_id', $request->page_id)->max('order') + 1,
            'content' => $content,
            'is_active' => true,
        ]);

        // Load relationships
        $section->load('customBlock');

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, $id)
    {
        $section = PageSection::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'content' => 'required|array',
        ]);

        $content = $request->content;

        // Handle file uploads for various image fields
        $imageFields = ['background_image', 'image', 'avatar', 'photo', 'thumbnail'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if (isset($section->content[$field]) && $section->content[$field]) {
                    Storage::disk('public')->delete($section->content[$field]);
                }

                $file = $request->file($field);
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('sections', $filename, 'public');
                $content[$field] = $path;
            }
        }

        // Handle multiple file uploads (for gallery, team members, etc.)
        if ($request->hasFile('images')) {
            // Delete old images if exists
            if (isset($section->content['images']) && is_array($section->content['images'])) {
                foreach ($section->content['images'] as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $images = [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('sections', $filename, 'public');
                $images[] = $path;
            }
            $content['images'] = $images;
        }

        $section->update([
            'name' => $request->name,
            'content' => $content,
            'is_active' => $request->has('is_active'),
        ]);

        // Load relationships
        $section->load('customBlock');

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->sections as $index => $id) {
            PageSection::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $section = PageSection::findOrFail($id);

        // Delete associated images
        if (isset($section->content['background_image'])) {
            Storage::disk('public')->delete($section->content['background_image']);
        }
        if (isset($section->content['image'])) {
            Storage::disk('public')->delete($section->content['image']);
        }
        if (isset($section->content['images']) && is_array($section->content['images'])) {
            foreach ($section->content['images'] as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $section->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Import CSV data for table sections
     */
    public function importCsv(Request $request, $id)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:10240', // 10MB max
        ]);

        $section = PageSection::findOrFail($id);

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));

        // First row is headers
        $headers = array_shift($csvData);

        // Convert to table data format
        $tableData = [
            'headers' => $headers,
            'rows' => $csvData,
        ];

        // Update section content with table data
        $content = $section->content;
        $content['table_data'] = $tableData;

        $section->update(['content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'CSV imported successfully',
            'table_data' => $tableData,
        ]);
    }

    /**
     * Add column to table section
     */
    public function addTableColumn(Request $request, $id)
    {
        $request->validate([
            'column_name' => 'required|string',
            'default_value' => 'nullable|string',
        ]);

        $section = PageSection::findOrFail($id);
        $content = $section->content;

        if (!isset($content['table_data'])) {
            return response()->json([
                'success' => false,
                'message' => 'This section does not contain table data',
            ], 400);
        }

        // Add column header
        $content['table_data']['headers'][] = $request->column_name;

        // Add default value to all rows
        foreach ($content['table_data']['rows'] as &$row) {
            $row[] = $request->default_value ?? '';
        }

        $section->update(['content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'Column added successfully',
            'table_data' => $content['table_data'],
        ]);
    }

    /**
     * Remove column from table section
     */
    public function removeTableColumn(Request $request, $id)
    {
        $request->validate([
            'column_index' => 'required|integer|min:0',
        ]);

        $section = PageSection::findOrFail($id);
        $content = $section->content;

        if (!isset($content['table_data'])) {
            return response()->json([
                'success' => false,
                'message' => 'This section does not contain table data',
            ], 400);
        }

        $columnIndex = $request->column_index;

        // Remove column header
        if (isset($content['table_data']['headers'][$columnIndex])) {
            array_splice($content['table_data']['headers'], $columnIndex, 1);
        }

        // Remove column data from all rows
        foreach ($content['table_data']['rows'] as &$row) {
            if (isset($row[$columnIndex])) {
                array_splice($row, $columnIndex, 1);
            }
        }

        $section->update(['content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'Column removed successfully',
            'table_data' => $content['table_data'],
        ]);
    }

    /**
     * Update table cell data
     */
    public function updateTableCell(Request $request, $id)
    {
        $request->validate([
            'row_index' => 'required|integer|min:0',
            'column_index' => 'required|integer|min:0',
            'value' => 'required|string',
        ]);

        $section = PageSection::findOrFail($id);
        $content = $section->content;

        if (!isset($content['table_data'])) {
            return response()->json([
                'success' => false,
                'message' => 'This section does not contain table data',
            ], 400);
        }

        $rowIndex = $request->row_index;
        $columnIndex = $request->column_index;

        if (isset($content['table_data']['rows'][$rowIndex][$columnIndex])) {
            $content['table_data']['rows'][$rowIndex][$columnIndex] = $request->value;
            $section->update(['content' => $content]);

            return response()->json([
                'success' => true,
                'message' => 'Cell updated successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid row or column index',
        ], 400);
    }

    /**
     * Export table data as CSV
     */
    public function exportTableCsv($id)
    {
        $section = PageSection::findOrFail($id);

        if (!isset($section->content['table_data'])) {
            return response()->json([
                'success' => false,
                'message' => 'This section does not contain table data',
            ], 400);
        }

        $tableData = $section->content['table_data'];

        // Build CSV content
        $csvContent = implode(',', array_map(function($header) {
            return '"' . str_replace('"', '""', $header) . '"';
        }, $tableData['headers'])) . "\n";

        foreach ($tableData['rows'] as $row) {
            $csvContent .= implode(',', array_map(function($cell) {
                return '"' . str_replace('"', '""', $cell) . '"';
            }, $row)) . "\n";
        }

        return response($csvContent, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="table-data-' . $section->id . '.csv"');
    }
}

