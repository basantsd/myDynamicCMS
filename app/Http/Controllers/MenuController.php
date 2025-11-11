<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('allItems')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function edit($id)
    {
        $menu = Menu::with('items.children')->findOrFail($id);
        $pages = Page::where('is_published', true)->get();

        return view('admin.menus.edit', compact('menu', 'pages'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'title' => 'required|max:255',
        ]);

        $item = MenuItem::create([
            'menu_id' => $request->menu_id,
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'url' => $request->url,
            'page_id' => $request->page_id,
            'target' => $request->target ?? '_self',
            'order' => MenuItem::where('menu_id', $request->menu_id)->max('order') + 1,
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'item' => $item->load('page')]);
    }

    public function updateItem(Request $request, $id)
    {
        $item = MenuItem::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $item->update([
            'title' => $request->title,
            'url' => $request->url,
            'page_id' => $request->page_id,
            'target' => $request->target ?? '_self',
            'parent_id' => $request->parent_id,
            'is_active' => $request->has('is_active'),
        ]);

        return response()->json(['success' => true, 'item' => $item->load('page')]);
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->items as $index => $itemData) {
            MenuItem::where('id', $itemData['id'])->update([
                'order' => $index,
                'parent_id' => $itemData['parent_id'] ?? null
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function destroyItem($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->delete();

        return response()->json(['success' => true]);
    }
}
