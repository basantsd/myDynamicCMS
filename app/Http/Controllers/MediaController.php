<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::with('uploader')->latest()->paginate(30);
        return view('admin.media.index', compact('media'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('media', $filename, 'public');

        $type = 'document';
        if (strpos($file->getMimeType(), 'image') !== false) {
            $type = 'image';
        } elseif (strpos($file->getMimeType(), 'video') !== false) {
            $type = 'video';
        }

        $media = Media::create([
            'title' => $request->title ?? $file->getClientOriginalName(),
            'file_name' => $filename,
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'type' => $type,
            'alt_text' => $request->alt_text,
            'description' => $request->description,
            'uploaded_by' => session('user_id'),
        ]);

        return response()->json(['success' => true, 'media' => $media]);
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $media->update([
            'title' => $request->title,
            'alt_text' => $request->alt_text,
            'description' => $request->description,
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
