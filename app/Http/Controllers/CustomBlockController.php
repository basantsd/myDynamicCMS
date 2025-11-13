<?php

namespace App\Http\Controllers;

use App\Models\CustomBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
     * Get list of all active custom blocks
     */
    public function list(Request $request)
    {
        try {
            $blocks = CustomBlock::where('is_active', 1)
                ->orderBy('category')
                ->orderBy('usage_count', 'desc')
                ->get();

            // Parse JSON fields
            $blocks = $blocks->map(function ($block) {
                return [
                    'id' => $block->id,
                    'name' => $block->name,
                    'icon' => $block->icon,
                    'color' => $block->color,
                    'category' => $block->category,
                    'description' => $block->description,
                    'preview_image' => $block->preview_image,
                    'html_template' => $block->html_template,
                    'css_styles' => $block->css_styles,
                    'js_scripts' => $block->js_scripts,
                    'schema' => json_decode($block->schema, true),
                    'traits_config' => json_decode($block->traits_config, true),
                    'dependencies' => json_decode($block->dependencies, true),
                    'default_values' => json_decode($block->default_values, true),
                    'tags' => json_decode($block->tags, true),
                    'advanced_features' => json_decode($block->advanced_features, true),
                    'action_settings' => json_decode($block->action_settings, true),
                    'form_table_name' => $block->form_table_name,
                    'block_version' => $block->block_version,
                    'usage_count' => $block->usage_count,
                ];
            });

            return response()->json([
                'success' => true,
                'blocks' => $blocks,
                'total' => $blocks->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load blocks',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'name' => 'required|string|max:255|unique:custom_blocks,name',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(CustomBlock::getCategories())),
            'description' => 'nullable|string',
            'html_template' => 'required|string',
            'css_styles' => 'nullable|string',
            'js_scripts' => 'nullable|string',
            'schema' => 'required|array',
            'traits_config' => 'nullable|array',
            'dependencies' => 'nullable|array',
            'default_values' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        // Decode JSON strings
        $schema = json_decode($request->schema, true);
        $defaultValues = $request->default_values ? json_decode($request->default_values, true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()
                ->withErrors(['schema' => 'Invalid JSON format'])
                ->withInput();
        }

        try {
            CustomBlock::create([
                'name' => $request->name,
                'icon' => $request->icon,
                'color' => $request->color,
                'category' => $request->category,
                'description' => $request->description,
                'html_template' => $request->html_template,
                'css_styles' => $request->css_styles,
                'js_scripts' => $request->js_scripts,
                'schema' => json_encode($request->schema),
                'traits_config' => json_encode($request->traits_config ?? []),
                'dependencies' => json_encode($request->dependencies ?? []),
                'default_values' => json_encode($request->default_values ?? []),
                'tags' => json_encode($request->tags ?? []),
                'block_version' => '1.0.0',
                'is_active' => 1,
                'usage_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.blocks.index')->with('success', 'Custom block created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Failed to create block : ' . $e->getMessage());
        }
    }

    /**
     * Get single block by ID
     */
    public function show($id)
    {
        try {
            $block = CustomBlock::where('id', $id)
                ->first();

            if (!$block) {
                return response()->json([
                    'success' => false,
                    'message' => 'Block not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'block' => [
                    'id' => $block->id,
                    'name' => $block->name,
                    'icon' => $block->icon,
                    'color' => $block->color,
                    'category' => $block->category,
                    'description' => $block->description,
                    'html_template' => $block->html_template,
                    'css_styles' => $block->css_styles,
                    'js_scripts' => $block->js_scripts,
                    'schema' => json_decode($block->schema, true),
                    'traits_config' => json_decode($block->traits_config, true),
                    'default_values' => json_decode($block->default_values, true),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load block',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'name' => 'sometimes|string|max:255|unique:custom_blocks,name,' . $id,
            'icon' => 'sometimes|string|max:255',
            'color' => 'sometimes|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(CustomBlock::getCategories())),
            'html_template' => 'sometimes|string',
            'css_styles' => 'nullable|string',
            'js_scripts' => 'nullable|string',
            'schema' => 'sometimes|array',
            'traits_config' => 'nullable|array',
            'default_values' => 'nullable|array'
        ]);

        // Decode JSON strings
        $schema = json_decode($request->schema, true);
        $defaultValues = $request->default_values ? json_decode($request->default_values, true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()
                ->withErrors(['schema' => 'Invalid JSON format'])
                ->withInput();
        }
        try {

            $updateData = array_filter($request->only([
                'name',
                'icon',
                'color',
                'category',
                'description',
                'html_template',
                'css_styles',
                'js_scripts'
            ]));

            if ($request->has('schema')) {
                $updateData['schema'] = json_encode($request->schema);
            }
            if ($request->has('traits_config')) {
                $updateData['traits_config'] = json_encode($request->traits_config);
            }
            if ($request->has('default_values')) {
                $updateData['default_values'] = json_encode($request->default_values);
            }
            if ($request->has('tags')) {
                $updateData['tags'] = json_encode($request->tags);
            }

            $updateData['updated_at'] = now();

            CustomBlock::where('id', $id)->update($updateData);

            return redirect()->route('admin.blocks.index')
                ->with('success', 'Custom block updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Failed to update block : ' . $e->getMessage());
        }
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
    // public function duplicate($id)
    // {
    //     $original = CustomBlock::findOrFail($id);

    //     $duplicate = CustomBlock::create([
    //         'name' => $original->name . ' (Copy)',
    //         'icon' => $original->icon,
    //         'category' => $original->category,
    //         'description' => $original->description,
    //         'schema' => $original->schema,
    //         'default_values' => $original->default_values,
    //         'preview_image' => $original->preview_image,
    //         'is_active' => false, // Duplicates start as inactive
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Block duplicated successfully',
    //         'block' => $duplicate,
    //     ]);
    // }



    /**
     * Track block usage
     */
    public function trackUsage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'required|exists:custom_blocks,id',
            'page_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Increment usage count
            DB::table('custom_blocks')
                ->where('id', $request->block_id)
                ->increment('usage_count');

            // Log usage
            DB::table('custom_block_usage')->insert([
                'block_id' => $request->block_id,
                'page_id' => $request->page_id,
                'user_id' => auth()->id(),
                'used_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usage tracked'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to track usage',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get blocks by category
     */
    public function byCategory($category)
    {
        try {
            $blocks = DB::table('custom_blocks')
                ->where('category', $category)
                ->where('is_active', 1)
                ->orderBy('usage_count', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'blocks' => $blocks,
                'category' => $category
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load blocks',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search blocks
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $category = $request->input('category');
        $tags = $request->input('tags', []);

        try {
            $blocks = DB::table('custom_blocks')
                ->where('is_active', 1)
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($sq) use ($query) {
                        $sq->where('name', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%");
                    });
                })
                ->when($category, function ($q) use ($category) {
                    $q->where('category', $category);
                })
                ->orderBy('usage_count', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'blocks' => $blocks,
                'query' => $query
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload block preview image
     */
    public function uploadPreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'required|exists:custom_blocks,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $image = $request->file('image');
            $path = $image->store('block-previews', 'public');

            DB::table('custom_blocks')
                ->where('id', $request->block_id)
                ->update([
                    'preview_image' => $path,
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'path' => Storage::url($path),
                'message' => 'Preview image uploaded'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clone/Duplicate block
     */
    public function duplicate($id)
    {
        try {
            $block = DB::table('custom_blocks')->where('id', $id)->first();

            if (!$block) {
                return response()->json([
                    'success' => false,
                    'message' => 'Block not found'
                ], 404);
            }

            $newBlockId = DB::table('custom_blocks')->insertGetId([
                'name' => $block->name . ' (Copy)',
                'icon' => $block->icon,
                'color' => $block->color,
                'category' => $block->category,
                'description' => $block->description,
                'preview_image' => $block->preview_image,
                'html_template' => $block->html_template,
                'css_styles' => $block->css_styles,
                'js_scripts' => $block->js_scripts,
                'schema' => $block->schema,
                'traits_config' => $block->traits_config,
                'dependencies' => $block->dependencies,
                'default_values' => $block->default_values,
                'tags' => $block->tags,
                'block_version' => $block->block_version,
                'is_active' => 1,
                'usage_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Block duplicated successfully',
                'new_block_id' => $newBlockId
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to duplicate block',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get block statistics
     */
    public function statistics()
    {
        try {
            $stats = [
                'total_blocks' => DB::table('custom_blocks')->count(),
                'active_blocks' => DB::table('custom_blocks')->where('is_active', 1)->count(),
                'total_usage' => DB::table('custom_block_usage')->count(),
                'by_category' => DB::table('custom_blocks')
                    ->select('category', DB::raw('count(*) as count'))
                    ->groupBy('category')
                    ->get(),
                'most_used' => DB::table('custom_blocks')
                    ->orderBy('usage_count', 'desc')
                    ->limit(5)
                    ->get(['id', 'name', 'usage_count']),
            ];

            return response()->json([
                'success' => true,
                'statistics' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
