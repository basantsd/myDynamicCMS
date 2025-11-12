<?php

namespace App\Http\Controllers;

use App\Models\CustomBlock;
use Illuminate\Http\Request;

class CustomBlockController extends Controller
{
    /**
     * Display a listing of custom blocks with search and filter
     */
    public function index(Request $request)
    {
        $query = CustomBlock::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->category($request->category);
        }

        // Active filter
        if ($request->has('active')) {
            $query->active();
        }

        // Sort by usage or name
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        if ($sortBy === 'usage') {
            $query->orderBy('usage_count', $sortOrder);
        } else {
            $query->orderBy('name', $sortOrder);
        }

        $blocks = $query->paginate(20);
        $categories = CustomBlock::getCategories();

        return view('admin.blocks.index', compact('blocks', 'categories'));
    }

    /**
     * Get all active blocks for block picker
     */
    public function list(Request $request)
    {
        $query = CustomBlock::active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->category($request->category);
        }

        $blocks = $query->orderBy('usage_count', 'desc')
                       ->orderBy('name', 'asc')
                       ->get();

        return response()->json([
            'success' => true,
            'blocks' => $blocks,
        ]);
    }

    /**
     * Show the form for creating a new custom block
     */
    public function create()
    {
        return view('admin.blocks.create');
    }

    /**
     * Store a newly created custom block
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'category' => 'required|string|in:' . implode(',', array_keys(CustomBlock::getCategories())),
            'description' => 'nullable|string',
            'schema' => 'required|string',
            'default_values' => 'nullable|string',
            'preview_image' => 'nullable|string',
        ]);

        // Decode JSON strings
        $schema = json_decode($request->schema, true);
        $defaultValues = $request->default_values ? json_decode($request->default_values, true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()
                ->withErrors(['schema' => 'Invalid JSON format'])
                ->withInput();
        }

        $block = CustomBlock::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'color' => $request->color,
            'category' => $request->category,
            'description' => $request->description,
            'schema' => $schema,
            'default_values' => $defaultValues,
            'preview_image' => $request->preview_image,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'Custom block created successfully');
    }

    /**
     * Display the specified custom block
     */
    public function show($id)
    {
        $block = CustomBlock::with('sections')->findOrFail($id);

        return response()->json([
            'success' => true,
            'block' => $block,
        ]);
    }

    /**
     * Show the form for editing the specified custom block
     */
    public function edit($id)
    {
        $block = CustomBlock::findOrFail($id);
        return view('admin.blocks.edit', compact('block'));
    }

    /**
     * Update the specified custom block
     */
    public function update(Request $request, $id)
    {
        $block = CustomBlock::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'category' => 'required|string|in:' . implode(',', array_keys(CustomBlock::getCategories())),
            'description' => 'nullable|string',
            'schema' => 'required|string',
            'default_values' => 'nullable|string',
            'preview_image' => 'nullable|string',
        ]);

        // Decode JSON strings
        $schema = json_decode($request->schema, true);
        $defaultValues = $request->default_values ? json_decode($request->default_values, true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()
                ->withErrors(['schema' => 'Invalid JSON format'])
                ->withInput();
        }

        $block->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'color' => $request->color,
            'category' => $request->category,
            'description' => $request->description,
            'schema' => $schema,
            'default_values' => $defaultValues,
            'preview_image' => $request->preview_image,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'Custom block updated successfully');
    }

    /**
     * Remove the specified custom block
     */
    public function destroy($id)
    {
        $block = CustomBlock::findOrFail($id);

        // Check if block is being used
        if ($block->usage_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete block that is currently in use',
            ], 400);
        }

        $block->delete();

        return response()->json([
            'success' => true,
            'message' => 'Custom block deleted successfully',
        ]);
    }

    /**
     * Toggle active status of a custom block
     */
    public function toggleActive($id)
    {
        $block = CustomBlock::findOrFail($id);
        $block->is_active = !$block->is_active;
        $block->save();

        return response()->json([
            'success' => true,
            'message' => 'Block status updated successfully',
            'is_active' => $block->is_active,
        ]);
    }

    /**
     * Duplicate a custom block
     */
    public function duplicate($id)
    {
        $original = CustomBlock::findOrFail($id);

        $duplicate = CustomBlock::create([
            'name' => $original->name . ' (Copy)',
            'icon' => $original->icon,
            'category' => $original->category,
            'description' => $original->description,
            'schema' => $original->schema,
            'default_values' => $original->default_values,
            'preview_image' => $original->preview_image,
            'is_active' => false, // Duplicates start as inactive
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Block duplicated successfully',
            'block' => $duplicate,
        ]);
    }
}
