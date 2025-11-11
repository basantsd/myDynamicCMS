<?php

namespace App\Http\Controllers;

use App\Models\CustomBlock;
use App\Models\PageSection;
use Illuminate\Http\Request;

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

        // If custom block is specified, increment its usage count
        if ($request->custom_block_id) {
            $customBlock = CustomBlock::find($request->custom_block_id);
            if ($customBlock) {
                $customBlock->incrementUsage();

                // Merge default values with provided content
                $content = array_merge(
                    $customBlock->default_values ?? [],
                    $request->content
                );
            } else {
                $content = $request->content;
            }
        } else {
            $content = $request->content;
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

        // Load relationship
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

        $section->update([
            'name' => $request->name,
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
        ]);

        // Load relationship
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
        $section->delete();

        return response()->json(['success' => true]);
    }
}
