<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::ordered()->paginate(20);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'button_action' => 'nullable|in:link,redirect,download,modal,scroll',
            'button_target' => 'nullable|in:_self,_blank',
            'button_style' => 'nullable|string',
            'button_text_2' => 'nullable|string|max:255',
            'button_url_2' => 'nullable|string|max:255',
            'button_action_2' => 'nullable|in:link,redirect,download,modal,scroll',
            'button_target_2' => 'nullable|in:_self,_blank',
            'button_style_2' => 'nullable|string',
            'banner_type' => 'required|in:hero,promotional,image,video,slider',
            'height' => 'nullable|string',
            'text_position' => 'nullable|in:left,center,right',
            'show_overlay' => 'boolean',
            'overlay_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'slides' => 'nullable|array',
            'autoplay' => 'boolean',
            'interval' => 'nullable|integer|min:1|max:30',
            'transition' => 'nullable|in:slide,fade,zoom',
            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner = Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'button_action' => 'nullable|in:link,redirect,download,modal,scroll',
            'button_target' => 'nullable|in:_self,_blank',
            'button_style' => 'nullable|string',
            'button_text_2' => 'nullable|string|max:255',
            'button_url_2' => 'nullable|string|max:255',
            'button_action_2' => 'nullable|in:link,redirect,download,modal,scroll',
            'button_target_2' => 'nullable|in:_self,_blank',
            'button_style_2' => 'nullable|string',
            'banner_type' => 'required|in:hero,promotional,image,video,slider',
            'height' => 'nullable|string',
            'text_position' => 'nullable|in:left,center,right',
            'show_overlay' => 'boolean',
            'overlay_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'slides' => 'nullable|array',
            'autoplay' => 'boolean',
            'interval' => 'nullable|integer|min:1|max:30',
            'transition' => 'nullable|in:slide,fade,zoom',
            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully');
    }

    public function list()
    {
        $banners = Banner::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'banners' => $banners->map(function ($banner) {
                return [
                    'id' => $banner->id,
                    'name' => $banner->name,
                    'title' => $banner->title,
                    'banner_type' => $banner->banner_type,
                    'html' => $banner->generateHtml(),
                ];
            }),
        ]);
    }
}
