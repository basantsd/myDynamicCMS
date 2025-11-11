<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'section_type' => 'required',
            'content' => 'required|array',
        ]);

        $section = PageSection::create([
            'page_id' => $request->page_id,
            'section_type' => $request->section_type,
            'order' => PageSection::where('page_id', $request->page_id)->max('order') + 1,
            'content' => $request->content,
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, $id)
    {
        $section = PageSection::findOrFail($id);

        $request->validate([
            'content' => 'required|array',
        ]);

        $section->update([
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
        ]);

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
