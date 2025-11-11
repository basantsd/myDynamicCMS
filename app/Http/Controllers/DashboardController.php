<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Media;
use App\Models\User;
use App\Models\MenuItem;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pages' => Page::count(),
            'published_pages' => Page::where('is_published', true)->count(),
            'total_media' => Media::count(),
            'total_users' => User::count(),
            'total_menu_items' => MenuItem::count(),
        ];

        $recent_pages = Page::with('creator')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_pages'));
    }
}
