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
        $totalPages = Page::count();
        $publishedPages = Page::where('is_published', true)->count();
        $totalMedia = Media::count();
        $mediaSize = $this->formatBytes(Media::sum('file_size'));
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalMenuItems = MenuItem::count();

        $recentPages = Page::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPages',
            'publishedPages',
            'totalMedia',
            'mediaSize',
            'totalUsers',
            'activeUsers',
            'totalMenuItems',
            'recentPages'
        ));
    }

    private function formatBytes($bytes, $precision = 2)
    {
        if ($bytes === 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB'];
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1024 ** $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
