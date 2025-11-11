# Dynamic CMS Architecture: Visual Builder vs Page Sections

## Overview

This CMS has **TWO DIFFERENT SYSTEMS** for managing page content. You can choose which one to use for each page:

### 1. **Visual Page Builder** (GrapesJS)
- Drag & drop visual editor
- Stores complete HTML/CSS
- Best for: Custom layouts, landing pages, unique designs

### 2. **Page Sections** (Traditional CMS)
- Structured content in database
- Reusable section templates
- Best for: Standard pages, consistent layouts, content management

---

## How the System Works

### Database Structure

```
pages table:
├── id
├── title, slug, meta_description, meta_keywords
├── template (which blade template to use)
├── use_builder (boolean) ← KEY DECISION POINT
├── builder_html (stores visual builder HTML)
├── builder_css (stores visual builder CSS)
├── builder_data (stores GrapesJS components JSON)
└── ...other fields

page_sections table:
├── id
├── page_id (foreign key to pages)
├── section_type (e.g., 'hero', 'core_values_cards', 'download_section')
├── name
├── content (JSON - stores section data)
├── order
├── is_active
└── created_at, updated_at
```

---

## Flow Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                    User Visits Page                          │
│                   example.com/about                          │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│            FrontendController::showPage($slug)               │
│                                                              │
│  1. Find page in database by slug                           │
│  2. Check: $page->use_builder                               │
└────────────────────────┬────────────────────────────────────┘
                         │
         ┌───────────────┴───────────────┐
         │                               │
    use_builder = TRUE           use_builder = FALSE
         │                               │
         ▼                               ▼
┌──────────────────────┐      ┌──────────────────────┐
│  VISUAL BUILDER      │      │  PAGE SECTIONS       │
│  RENDERING           │      │  RENDERING           │
└──────────────────────┘      └──────────────────────┘
         │                               │
         │                               │
         ▼                               ▼
┌──────────────────────┐      ┌──────────────────────┐
│ frontend/builder     │      │ frontend/templates/  │
│ .blade.php           │      │ {template}.blade.php │
│                      │      │                      │
│ Outputs:             │      │ Outputs:             │
│ {!! $page->         │      │ @foreach($sections)  │
│     builder_html !!}│      │   {!! $section->     │
│                      │      │       content !!}    │
│ {!! $page->         │      │ @endforeach          │
│     builder_css !!} │      │                      │
└──────────────────────┘      └──────────────────────┘
```

---

## OPTION 1: Visual Builder (GrapesJS)

### How It Works:

**Admin Side - Editing:**
1. User goes to **Admin → Pages → [Page Name] → Visual Builder**
2. Opens GrapesJS drag-and-drop editor
3. Drags Treasury blocks (Carousel, Downloads, News Cards, etc.)
4. Clicks "Add Slide" / "Add Item" buttons to add more content
5. Edits text, links, icons directly in the editor
6. Clicks **"Save Page"**
7. System saves:
   - `builder_html` = Complete HTML output
   - `builder_css` = Custom CSS styles
   - `builder_data` = GrapesJS component JSON (for re-editing)
   - `use_builder` = TRUE

**Frontend Side - Displaying:**
```php
// FrontendController.php (line 41-42)
if ($page->use_builder && $page->builder_html) {
    return view('frontend.builder', compact('page'));
}
```

**Blade Template:**
```blade
<!-- frontend/builder.blade.php -->
@section('content')
    @if($page->builder_css)
        <style>
            {!! $page->builder_css !!}
        </style>
    @endif

    <div class="builder-content">
        {!! $page->builder_html !!}
    </div>
@endsection
```

### What Gets Stored in Database:

**Example: Page with Carousel created in Visual Builder**

```sql
-- pages table
id: 1
title: "Home"
slug: "home"
use_builder: 1  ← TRUE (uses visual builder)
builder_html: "<section class='treasury-carousel-section'>
                  <div id='heroCarousel' class='carousel slide'>
                    <div class='carousel-inner'>
                      <div class='carousel-item active'>
                        <h1>Welcome</h1>
                        <p>Description...</p>
                      </div>
                      <div class='carousel-item'>
                        <h1>Slide 2</h1>
                      </div>
                    </div>
                  </div>
                </section>"
builder_css: ".carousel-item { min-height: 500px; }"
builder_data: {"components": [...], "styles": [...]}  ← For re-editing

-- page_sections table
(NO RECORDS - Visual Builder doesn't use page_sections)
```

---

## OPTION 2: Page Sections (Traditional CMS)

### How It Works:

**Admin Side - Creating:**
1. User runs `php artisan db:seed --class=PageSeeder`
2. System creates pages and their sections:

```php
// PageSeeder.php
$about = Page::create([
    'title' => 'About Us',
    'slug' => 'about',
    'template' => 'treasury',
    'use_builder' => false,  // ← Uses page sections
]);

PageSection::create([
    'page_id' => $about->id,
    'section_type' => 'hero',
    'content' => [
        'html' => '<section class="page-hero">
                     <h1>About Us</h1>
                   </section>'
    ],
    'order' => 1,
    'is_active' => true,
]);

PageSection::create([
    'page_id' => $about->id,
    'section_type' => 'core_values_cards',
    'content' => [
        'html' => '<section class="core-values-section">
                     <div class="core-card">...</div>
                   </section>'
    ],
    'order' => 2,
    'is_active' => true,
]);
```

**Frontend Side - Displaying:**
```php
// FrontendController.php (line 45-58)
// Load page sections from database
$sections = $page->sections()
    ->where('is_active', true)
    ->orderBy('order')
    ->get();

// Use template-specific view
if (view()->exists("frontend.templates.{$template}")) {
    return view("frontend.templates.{$template}", compact('page', 'sections'));
}
```

**Blade Template:**
```blade
<!-- frontend/templates/treasury.blade.php -->
@section('content')
    @if($page->use_builder && $page->builder_html)
        <!-- Visual Builder Content -->
        {!! $page->builder_html !!}
    @else
        <!-- Section-Based Content -->
        @foreach($sections as $section)
            @if($section->is_active)
                <div class="page-section">
                    {!! $section->content['html'] !!}
                </div>
            @endif
        @endforeach
    @endif
@endsection
```

### What Gets Stored in Database:

**Example: "About Us" page with Page Sections**

```sql
-- pages table
id: 2
title: "About Us"
slug: "about"
template: "treasury"
use_builder: 0  ← FALSE (uses page sections)
builder_html: NULL
builder_css: NULL
builder_data: NULL

-- page_sections table
id: 1
page_id: 2
section_type: "hero"
name: "About Hero"
content: {"html": "<section class='page-hero'><h1>About Us</h1></section>"}
order: 1
is_active: 1

id: 2
page_id: 2
section_type: "core_values_cards"
name: "Core Values"
content: {"html": "<section class='core-values-section'>...</section>"}
order: 2
is_active: 1
```

---

## Key Differences

| Feature | Visual Builder | Page Sections |
|---------|---------------|---------------|
| **Editing Method** | Drag & drop GrapesJS | Database seeder / Admin form |
| **Storage** | `builder_html` + `builder_css` | `page_sections` table |
| **Flexibility** | Completely custom layouts | Structured, consistent |
| **Reusability** | One-time design | Reusable section templates |
| **Content Structure** | Flat HTML blob | Organized by section type |
| **Best For** | Landing pages, custom designs | Standard pages, blogs, content |
| **Admin UI** | Visual editor with add/remove buttons | Form-based or seeder-based |

---

## How Templates Work

Both systems can use the **same template** (e.g., `treasury` template):

```blade
<!-- frontend/templates/treasury.blade.php -->
@extends('frontend.layouts.treasury')

@section('content')
    @if($page->use_builder && $page->builder_html)
        <!-- Path 1: Visual Builder HTML -->
        <div class="builder-content">
            {!! $page->builder_html !!}
        </div>
    @else
        <!-- Path 2: Loop through page sections -->
        @foreach($sections as $section)
            @if($section->is_active)
                {!! $section->content['html'] !!}
            @endif
        @endforeach
    @endif
@endsection
```

The template checks `use_builder` and renders accordingly!

---

## Real-World Examples

### Example 1: Home Page with Visual Builder

**Admin creates:**
1. Go to Pages → Home → Visual Builder
2. Drag "Carousel" block
3. Click "Add Slide" 5 times → Now has 6 slides
4. Drag "Core Values" block
5. Click "Add Card" 2 times → Now has 3 value cards
6. Save

**Database stores:**
```php
// pages.builder_html contains:
"<section class='treasury-carousel-section'>
   <div class='carousel-inner'>
     <div class='carousel-item active'>Slide 1</div>
     <div class='carousel-item'>Slide 2</div>
     ... (6 slides total)
   </div>
 </section>
 <section class='core-values-section'>
   <div class='core-card'>Value 1</div>
   <div class='core-card'>Value 2</div>
   <div class='core-card'>Value 3</div>
 </section>"
```

**Frontend renders:**
```php
// FrontendController detects use_builder = true
// Loads frontend/builder.blade.php
// Outputs the builder_html directly
```

### Example 2: About Page with Page Sections

**Admin creates via Seeder:**
```php
$about = Page::create(['title' => 'About', 'use_builder' => false]);

PageSection::create([
    'page_id' => $about->id,
    'content' => ['html' => '<section>Hero</section>'],
    'order' => 1
]);

PageSection::create([
    'page_id' => $about->id,
    'content' => ['html' => '<section>Content</section>'],
    'order' => 2
]);
```

**Database stores:**
```
pages: {id: 2, title: "About", use_builder: 0}
page_sections: [
  {page_id: 2, content: {html: "..."}, order: 1},
  {page_id: 2, content: {html: "..."}, order: 2}
]
```

**Frontend renders:**
```php
// FrontendController detects use_builder = false
// Loads $sections = $page->sections()->get()
// Loads frontend/templates/treasury.blade.php
// Loops through $sections and outputs each content['html']
```

---

## Why Two Systems?

### Visual Builder Benefits:
✅ **Creative Freedom** - Drag blocks anywhere, unlimited customization
✅ **Easy for Non-Developers** - Visual interface, no code needed
✅ **Quick Prototyping** - Build landing pages fast
✅ **Live Preview** - See changes immediately

### Page Sections Benefits:
✅ **Structured Content** - Organized, queryable data
✅ **Consistency** - Reusable section templates
✅ **SEO-Friendly** - Structured data easier to optimize
✅ **Bulk Management** - Update many pages via seeder
✅ **Version Control** - Section changes via code/migration

---

## How to Choose

**Use Visual Builder when:**
- Building a unique landing page
- Need custom layout not in templates
- Client wants drag-and-drop editing
- One-off page design

**Use Page Sections when:**
- Creating many similar pages (blog posts, products)
- Want consistent structure across pages
- Need to query/filter sections
- Managing content via database/seeder

---

## Summary

```
┌─────────────────────────────────────────────────────────────┐
│                      Your CMS Has:                           │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  📊 DATABASE LAYER                                           │
│    ├─ pages table (common metadata)                         │
│    ├─ pages.use_builder (decision flag)                     │
│    ├─ pages.builder_html (Visual Builder storage)           │
│    └─ page_sections table (Section storage)                 │
│                                                              │
│  🎨 ADMIN EDITING                                            │
│    ├─ Visual Builder → GrapesJS drag & drop                 │
│    └─ Page Sections → Database seeder / Forms               │
│                                                              │
│  🌐 FRONTEND RENDERING                                       │
│    ├─ FrontendController checks use_builder flag            │
│    ├─ Visual Builder → Renders builder_html                 │
│    └─ Page Sections → Loops $sections, renders content      │
│                                                              │
│  📄 TEMPLATES (Blade)                                        │
│    ├─ treasury.blade.php (handles both types)               │
│    ├─ builder.blade.php (Visual Builder specific)           │
│    └─ Checks use_builder, renders accordingly               │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

## Current State

**What I've Built:**

1. ✅ **Visual Builder with Treasury Blocks**
   - 10 custom blocks (Carousel, Downloads, News, etc.)
   - Dynamic add/remove controls
   - Easy drag & drop interface

2. ✅ **Page Sections System**
   - 25+ pre-seeded pages with sections
   - Structured content in database
   - Treasury template support

3. ✅ **Flexible Rendering**
   - FrontendController decides which system to use
   - Templates support both rendering methods
   - SEO fallback (page → site settings)

**Both systems work independently and perfectly together!**
