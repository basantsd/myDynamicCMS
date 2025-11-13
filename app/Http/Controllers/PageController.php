<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('creator', 'parent')->latest()->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $pages = Page::whereNull('parent_id')->get();
        $templates = ['default', 'treasury', 'home', 'contact', 'about', 'team'];
        return view('admin.pages.create', compact('pages', 'templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug',
            'template' => 'required',
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => $request->slug ?: Str::slug($request->title),
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'template' => $request->template,
            'is_published' => $request->has('is_published'),
            'show_in_menu' => $request->has('show_in_menu'),
            'menu_order' => $request->menu_order ?? 0,
            'parent_id' => $request->parent_id,
            'created_by' => auth()->id(),
        ]);

        return redirect('/admin/pages/' . $page->id . '/edit')->with('success', 'Page created successfully!');
    }

    public function edit($id)
    {
        $page = Page::with('sections')->findOrFail($id);
        $pages = Page::where('id', '!=', $id)->get();

        return view('admin.pages.edit-new', compact('page', 'pages'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $id,
            'template' => 'required',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug ?: Str::slug($request->title),
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'template' => $request->template,
            'is_published' => $request->has('is_published'),
            'show_in_menu' => $request->has('show_in_menu'),
            'menu_order' => $request->menu_order ?? 0,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Page updated successfully!');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect('/admin/pages')->with('success', 'Page deleted successfully!');
    }

    public function builder($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.builder-enhanced', compact('page'));
    }

    public function builderSave(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $updateData = [
            'use_builder' => $request->use_builder ?? true,
            'builder_html' => $request->builder_html,
            'builder_css' => $request->builder_css,
            'builder_data' => $request->builder_data,
        ];

        // Also update page settings if provided
        if ($request->has('title')) {
            $updateData['title'] = $request->title;
        }
        if ($request->has('slug')) {
            $updateData['slug'] = $request->slug;
        }
        if ($request->has('template')) {
            $updateData['template'] = $request->template;
        }
        if ($request->has('is_published')) {
            $updateData['is_published'] = $request->is_published;
        }
        if ($request->has('show_in_menu')) {
            $updateData['show_in_menu'] = $request->show_in_menu;
        }

        $page->update($updateData);

        return response()->json(['success' => true, 'message' => 'Page saved successfully!']);
    }
}
