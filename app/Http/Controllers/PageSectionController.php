<?php

namespace App\Http\Controllers;

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
            'content' => 'required|array',
        ]);

        $content = $request->content;

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
            'order' => PageSection::where('page_id', $request->page_id)->max('order') + 1,
            'content' => $content,
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
            'content' => $content,
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
}
