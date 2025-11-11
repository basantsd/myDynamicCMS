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
            // If no home page, use the first published page
            $page = Page::where('is_published', true)->orderBy('created_at')->first();
        }

        if (!$page) {
            // If no pages at all, show welcome message
            return view('frontend.welcome', $this->getCommonData());
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

        // Check if page uses visual builder
        if ($page->use_builder && $page->builder_html) {
            return view('frontend.builder', array_merge($this->getCommonData(), compact('page')));
        }

        // Otherwise use section-based rendering
        $sections = $page->sections()->where('is_active', true)->orderBy('order')->get();
        $data = array_merge($this->getCommonData(), compact('page', 'sections'));

        // Try to use template-specific view, fall back to slug-based view, then to default
        $template = $page->template ?? 'default';

        if (view()->exists("frontend.templates.{$template}")) {
            return view("frontend.templates.{$template}", $data);
        } elseif (view()->exists("frontend.{$page->slug}")) {
            return view("frontend.{$page->slug}", $data);
        } else {
            return view('frontend.default', $data);
        }
    }

    private function getCommonData()
    {
        $headerMenu = Menu::where('location', 'header')
            ->with(['items' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }, 'items.children' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }, 'items.page', 'items.children.page'])
            ->first();

        $footerMenu = Menu::where('location', 'footer')
            ->with(['items' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }, 'items.page'])
            ->first();

        $mobileMenu = Menu::where('location', 'mobile')
            ->with(['items' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }, 'items.children' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }, 'items.page', 'items.children.page'])
            ->first();

        // Use header menu for mobile if mobile menu doesn't exist
        if (!$mobileMenu) {
            $mobileMenu = $headerMenu;
        }

        $settings = Setting::pluck('value', 'key');

        return compact('headerMenu', 'footerMenu', 'mobileMenu', 'settings');
    }
}
