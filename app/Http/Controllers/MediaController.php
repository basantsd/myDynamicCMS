<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(30);
        return view('admin.media.index', compact('media'));
    }

    /**
     * Get media list for API (used in page builder)
     */
    public function list(Request $request)
    {
        $query = Media::query();

        // Filter by type if specified
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $media = $query->latest()->paginate(24);

        return response()->json([
            'success' => true,
            'media' => $media->items(),
            'pagination' => [
                'current_page' => $media->currentPage(),
                'last_page' => $media->lastPage(),
                'total' => $media->total(),
            ]
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|max:10240', // 10MB max per file
        ]);

        $uploadedFiles = [];

        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $filename, 'public');

            $type = 'other';
            $mimeType = $file->getMimeType();
            if (strpos($mimeType, 'image') !== false) {
                $type = 'image';
            } elseif (strpos($mimeType, 'video') !== false) {
                $type = 'video';
            } elseif (in_array($file->getClientOriginalExtension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) {
                $type = 'document';
            }

            $media = Media::create([
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'file_name' => $filename,
                'file_path' => $path,
                'mime_type' => $mimeType,
                'file_size' => $file->getSize(),
                'type' => $type,
                'alt_text' => '',
                'uploaded_by' => auth()->id(),
            ]);

            $uploadedFiles[] = $media;
        }

        // If AJAX request, return JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' file(s) uploaded successfully!',
                'media' => $uploadedFiles
            ]);
        }

        return back()->with('success', count($uploadedFiles) . ' file(s) uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $media->update([
            'title' => $request->title,
            'alt_text' => $request->alt_text,
        ]);

        return response()->json(['success' => true, 'media' => $media]);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return response()->json(['success' => true]);
    }
}
