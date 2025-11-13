# Page Sections System - Complete Guide

## What is the `page_sections` Table?

The `page_sections` table stores **structured, reusable content blocks** for your pages. Unlike the Visual Builder (which stores complete HTML), page sections are **database-driven components** that can be added, edited, and reordered through the admin panel.

---

## Database Structure

```sql
page_sections table:
├── id (primary key)
├── page_id (foreign key → pages.id)
├── section_type (e.g., 'hero_banner', 'rich_content', 'core_values_cards')
├── name (section name for admin reference)
├── content (JSON - stores all section data)
├── order (sort order on page)
├── is_active (boolean - show/hide)
└── created_at, updated_at
```

---

## Where Page Sections Are Used

### 1. **Admin Panel** - Creating & Editing Sections

**Location:** `http://your-site.com/admin/pages/{page-id}/edit`

**Interface:**
```
┌─────────────────────────────────────────────────────────┐
│ Tabs: [Page Settings] [Section Builder] [Visual Builder]│
│                                                          │
│ ┌─ Section Builder Tab ──────────────────────────────┐  │
│ │                                                     │  │
│ │ [+ Add Section] button                             │  │
│ │                                                     │  │
│ │ ┌─ Section 1 ───────────────────────────────────┐  │  │
│ │ │ 🔹 HERO BANNER | Order: 1                     │  │  │
│ │ │ Title: "Welcome to Treasury"                  │  │  │
│ │ │ [✏️ Edit] [🗑️ Delete]                          │  │  │
│ │ └───────────────────────────────────────────────┘  │  │
│ │                                                     │  │
│ │ ┌─ Section 2 ───────────────────────────────────┐  │  │
│ │ │ 🔹 CORE VALUES CARDS | Order: 2               │  │  │
│ │ │ Content: {...}                                │  │  │
│ │ │ [✏️ Edit] [🗑️ Delete]                          │  │  │
│ │ └───────────────────────────────────────────────┘  │  │
│ │                                                     │  │
│ └─────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

**Steps to Edit:**

1. Go to **Admin → Pages**
2. Click **Edit** on any page
3. Click **"Section Builder"** tab
4. Click **[+ Add Section]** button
5. Choose section type from modal
6. Fill in form fields (title, content, images, etc.)
7. Click **Save**
8. Sections appear in list
9. Drag sections by grip icon 🔹 to reorder
10. Click ✏️ to edit, 🗑️ to delete

---

### 2. **Database Seeder** - Creating Sections via Code

**Location:** `database/seeders/PageSeeder.php`

**How It Works:**

```php
// Create a page
$about = Page::create([
    'title' => 'About Us',
    'slug' => 'about',
    'template' => 'treasury',
    'use_builder' => false,  // ← Important! Use sections, not Visual Builder
]);

// Add Section 1: Hero
PageSection::create([
    'page_id' => $about->id,
    'section_type' => 'hero',
    'name' => 'About Hero',
    'content' => [
        'html' => '<section class="page-hero">
                     <h1>About Us</h1>
                     <p>Learn about our department</p>
                   </section>'
    ],
    'order' => 1,
    'is_active' => true,
]);

// Add Section 2: Core Values
PageSection::create([
    'page_id' => $about->id,
    'section_type' => 'core_values_cards',
    'name' => 'Core Values',
    'content' => [
        'html' => '<section class="core-values-section">
                     <div class="core-card">...</div>
                   </section>'
    ],
    'order' => 2,
    'is_active' => true,
]);
```

**Run Seeder:**
```bash
php artisan db:seed --class=PageSeeder
```

This creates 25+ pages with structured sections already populated!

---

### 3. **Frontend Display** - Rendering Sections

**Flow:**

```
User visits: http://your-site.com/about
                    ↓
        FrontendController::showPage('about')
                    ↓
        Finds page in database
                    ↓
        Checks: $page->use_builder?
                    ↓
               ┌────┴────┐
               NO        YES
               ↓         ↓
        Use SECTIONS  Use BUILDER HTML
               ↓
        Load sections from database:
        $sections = $page->sections()
                         ->where('is_active', true)
                         ->orderBy('order')
                         ->get();
               ↓
        Pass to template:
        resources/views/frontend/templates/treasury.blade.php
               ↓
        Template loops through sections:
        @foreach($sections as $section)
            {!! $section->content['html'] !!}
        @endforeach
               ↓
        Browser renders complete page!
```

**Template Code:**

```blade
<!-- resources/views/frontend/templates/treasury.blade.php -->

@extends('frontend.layouts.treasury')

@section('content')
    @if($page->use_builder && $page->builder_html)
        <!-- Visual Builder Path -->
        <div class="builder-content">
            {!! $page->builder_html !!}
        </div>
    @else
        <!-- Page Sections Path -->
        @foreach($sections as $section)
            @if($section->is_active)
                <div class="page-section" data-section-type="{{ $section->section_type }}">
                    @if(isset($section->content['html']))
                        {!! $section->content['html'] !!}
                    @else
                        @include('frontend.sections.' . $section->section_type, ['content' => $section->content])
                    @endif
                </div>
            @endif
        @endforeach
    @endif
@endsection
```

---

## Real Example: "About Us" Page

### Database State:

```sql
-- pages table
INSERT INTO pages (id, title, slug, template, use_builder) VALUES
(2, 'About Us', 'about', 'treasury', 0);  -- use_builder = 0 (uses sections)

-- page_sections table
INSERT INTO page_sections (page_id, section_type, content, order, is_active) VALUES
(2, 'hero', '{"html": "<section class=\"page-hero\"><h1>About Us</h1></section>"}', 1, 1),
(2, 'core_values_cards', '{"html": "<section class=\"core-values-section\">...</section>"}', 2, 1),
(2, 'team', '{"html": "<section class=\"team-section\">...</section>"}', 3, 1);
```

### Frontend Rendering:

**URL:** `http://your-site.com/about`

**Controller:**
```php
// FrontendController.php
$page = Page::where('slug', 'about')->first();
// use_builder = false, so load sections

$sections = $page->sections()
    ->where('is_active', true)
    ->orderBy('order')
    ->get();
// Returns 3 sections (hero, core_values_cards, team)

return view('frontend.templates.treasury', compact('page', 'sections'));
```

**Template Renders:**
```html
<!-- Output HTML -->
<section class="page-hero">
    <h1>About Us</h1>
</section>

<section class="core-values-section">
    ... core values cards ...
</section>

<section class="team-section">
    ... team member cards ...
</section>
```

---

## Section Types Available

**Defined in:** `app/Models/PageSection.php`

```php
const TYPE_HERO_BANNER = 'hero_banner';
const TYPE_RICH_CONTENT = 'rich_content';
const TYPE_DATA_TABLE = 'data_table';
const TYPE_IMAGE_GALLERY = 'image_gallery';
const TYPE_SERVICES_GRID = 'services_grid';
const TYPE_CONTACT_FORM = 'contact_form';
const TYPE_FAQ = 'faq';
const TYPE_TEAM = 'team';
const TYPE_TESTIMONIALS = 'testimonials';
const TYPE_STATISTICS = 'statistics';
const TYPE_BREADCRUMB = 'breadcrumb';
```

**Custom Types (Added in PageSeeder):**
```php
'hero'                  // Hero banner
'content'               // General content
'core_values_cards'     // Value cards
'mission_section'       // Mission statement
'mandate_box'           // Mandate boxes
'division_boxes'        // Division cards
'profile_cards'         // Team profiles
'budget_box'            // Budget documents
'download_section'      // Download files
'calculator_box'        // Calculators
'treasury_news_cards'   // News items
'public_notice_cards'   // Public notices
'guarantee_cards'       // Government guarantees
'filter_download_box'   // Filtered downloads
```

---

## Admin Interface for Editing Sections

**Location:** `/admin/pages/{page-id}/edit` → **Section Builder** tab

### Features:

1. **Add Section Button:**
   - Opens modal with section type dropdown
   - Form fields change based on section type
   - Upload images, enter text, set links

2. **Section List:**
   - Shows all sections for the page
   - Displays section type, order, active status
   - Preview of content

3. **Drag & Drop Reordering:**
   - Grab sections by grip icon 🔹
   - Drag to reorder
   - Order saves automatically via AJAX

4. **Edit Button ✏️:**
   - Opens modal with existing content
   - Edit all fields
   - Save updates via AJAX

5. **Delete Button 🗑️:**
   - Confirms deletion
   - Removes section from database
   - Also deletes uploaded images

### JavaScript Functions:

**File:** `resources/views/admin/pages/edit-with-tabs.blade.php`

```javascript
// Edit section
function editSection(sectionId) {
    // Fetch section data
    // Populate edit modal form
    // Show modal
}

// Delete section
function deleteSection(sectionId) {
    if (confirm('Delete this section?')) {
        fetch(`/admin/page-sections/${sectionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

// Reorder sections (drag & drop)
// Uses Sortable.js library
```

---

## Controller Endpoints

**File:** `app/Http/Controllers/PageSectionController.php`

### Routes:

```php
POST   /admin/page-sections           → store()      // Create new section
PUT    /admin/page-sections/{id}      → update()     // Update section
POST   /admin/page-sections/reorder   → updateOrder() // Reorder sections
DELETE /admin/page-sections/{id}      → destroy()    // Delete section
```

### What They Do:

**store():**
- Validates section data
- Handles image uploads
- Creates new PageSection record
- Returns JSON response

**update():**
- Finds section by ID
- Updates content
- Handles new image uploads
- Deletes old images
- Returns JSON response

**updateOrder():**
- Receives array of section IDs in new order
- Updates order column for each section
- Returns JSON response

**destroy():**
- Finds section by ID
- Deletes associated images from storage
- Deletes section record
- Returns JSON response

---

## Content Structure

Sections store content in JSON format in the `content` column.

### Example 1: Hero Banner Section

```json
{
    "html": "<section class=\"page-hero\">
               <div class=\"container\">
                 <h1>About Us</h1>
                 <p class=\"lead\">Learn about our department</p>
               </div>
             </section>"
}
```

### Example 2: Core Values Cards Section

```json
{
    "html": "<section class=\"core-values-section py-5\">
               <div class=\"container\">
                 <h2>Our Core Values</h2>
                 <div class=\"row\">
                   <div class=\"col-md-4\">
                     <div class=\"core-card\">
                       <i class=\"fas fa-shield-alt\"></i>
                       <h5>Transparency</h5>
                       <p>Open communication</p>
                     </div>
                   </div>
                   <!-- more cards -->
                 </div>
               </div>
             </section>"
}
```

### Example 3: Team Section (with image)

```json
{
    "title": "Our Team",
    "members": [
        {
            "name": "John Doe",
            "position": "Accountant General",
            "bio": "Leading the department...",
            "image": "sections/1699876543_abc123_profile.jpg"
        }
    ]
}
```

---

## How Sections Show on Frontend

### Blade Template Logic:

```blade
@foreach($sections as $section)
    @if($section->is_active)
        <div class="page-section" data-section-type="{{ $section->section_type }}">
            @if(isset($section->content['html']))
                <!-- If content has 'html' key, render it directly -->
                {!! $section->content['html'] !!}
            @else
                <!-- Otherwise, use a section-specific partial view -->
                @include('frontend.sections.' . $section->section_type, ['content' => $section->content])
            @endif
        </div>
    @endif
@endforeach
```

### Two Ways to Render:

**Method 1: Direct HTML (Current PageSeeder approach)**
```php
PageSection::create([
    'content' => [
        'html' => '<section>Complete HTML here</section>'
    ]
]);
```

**Method 2: Structured Data + Partial View**
```php
PageSection::create([
    'content' => [
        'title' => 'Our Team',
        'members' => [...]
    ]
]);
```

Then create: `resources/views/frontend/sections/team.blade.php`
```blade
<section class="team-section">
    <h2>{{ $content['title'] }}</h2>
    @foreach($content['members'] as $member)
        <div class="team-member">
            <img src="{{ asset('storage/' . $member['image']) }}">
            <h3>{{ $member['name'] }}</h3>
            <p>{{ $member['position'] }}</p>
        </div>
    @endforeach
</section>
```

---

## Summary

### Page Sections Table Is Used In:

1. ✅ **Admin Panel** → `/admin/pages/{id}/edit` → Section Builder tab
   - Add, edit, delete, reorder sections
   - Upload images, enter content
   - Real-time preview

2. ✅ **Database Seeder** → `PageSeeder.php`
   - Creates 25+ pages with pre-populated sections
   - Structured, ready-to-use content

3. ✅ **Frontend Display** → `FrontendController` + `treasury.blade.php`
   - Loads sections from database
   - Renders in order
   - Shows only active sections

4. ✅ **API Endpoints** → `PageSectionController`
   - CRUD operations (Create, Read, Update, Delete)
   - Image upload handling
   - Order management

### Key Points:

- **Structured Content** - Organized by section type
- **Reusable** - Same section type can be used on multiple pages
- **Editable** - Admin interface for easy management
- **Dynamic** - Content comes from database, not hardcoded files
- **SEO-Friendly** - Structured data easier to optimize
- **Flexible** - Can store HTML or structured JSON

### When to Use Page Sections vs Visual Builder:

**Use Page Sections:**
- Standard pages with consistent structure
- Content-heavy pages (blogs, articles)
- Need to query/filter specific sections
- Want structured, database-driven content

**Use Visual Builder:**
- Unique, custom layouts
- Landing pages
- Creative designs
- One-off pages

**Both work perfectly together in the same CMS!**
