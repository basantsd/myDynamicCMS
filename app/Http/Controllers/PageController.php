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
        $templates = ['default', 'home', 'contact', 'about', 'team'];
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
        $pages = Page::where('id', '!=', $id)->whereNull('parent_id')->get();
        $templates = ['default', 'home', 'contact', 'about', 'team'];
        $sectionTypes = PageSection::getSectionTypes();

        return view('admin.pages.edit-with-tabs', compact('page', 'pages', 'templates', 'sectionTypes'));
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
        return view('admin.pages.builder', compact('page'));
    }

    public function builderSave(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $page->update([
            'use_builder' => $request->use_builder ?? true,
            'builder_html' => $request->builder_html,
            'builder_css' => $request->builder_css,
            'builder_data' => $request->builder_data,
        ]);

        return response()->json(['success' => true, 'message' => 'Page saved successfully!']);
    }
}
