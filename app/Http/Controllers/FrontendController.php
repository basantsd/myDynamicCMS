<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Menu;
use App\Models\Setting;

class FrontendController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first();

        if (!$page) {
            $page = Page::where('is_published', true)->first();
        }

        return $this->renderPage($page);
    }

    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return $this->renderPage($page);
    }

    private function renderPage($page)
    {
        if (!$page) {
            abort(404);
        }

        $sections = $page->sections()->where('is_active', true)->orderBy('order')->get();
        $headerMenu = Menu::where('location', 'header')->with('items.children')->first();
        $footerMenu = Menu::where('location', 'footer')->with('items.children')->first();
        $settings = Setting::pluck('value', 'key');

        $template = $page->template ?? 'default';

        return view("frontend.templates.{$template}", compact('page', 'sections', 'headerMenu', 'footerMenu', 'settings'));
    }
}
