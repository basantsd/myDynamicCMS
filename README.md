# DynamicCMS - Lightweight Content Management System

A modern, lightweight, and user-friendly CMS built with Laravel, designed to make your existing HTML/CSS website dynamic and easily manageable. Think of it as a lighter, more intuitive alternative to WordPress.

## 📋 Table of Contents

- [Features](#-features)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [Admin Panel Guide](#-admin-panel-guide)
- [Dynamic Sections](#-dynamic-sections)
- [Frontend Integration](#-frontend-integration)
- [User Roles & Permissions](#-user-roles--permissions)
- [API Reference](#-api-reference)
- [Customization](#-customization)
- [Troubleshooting](#-troubleshooting)

---

## 🚀 Features

### Core CMS Features
- ✅ **Dynamic Page Management** - Create, edit, and publish pages
- ✅ **Nested Menu System** - Unlimited nested menu levels
- ✅ **Media Library** - Upload and manage images, documents, and files
- ✅ **User Management** - Multi-user support with roles and permissions
- ✅ **Site Settings** - Centralized configuration management
- ✅ **SEO Friendly** - Meta descriptions, keywords, and clean URLs

### Dynamic Content Sections
- 🎨 **Hero Banner** - Full-width hero sections with images and CTAs
- 📝 **Rich HTML Content** - WYSIWYG editor for rich text
- 📊 **Data Tables** - Responsive, customizable data tables
- 🖼️ **Image Gallery** - Photo galleries with lightbox
- 🛠️ **Services Grid** - Service/feature showcases with icons
- 📧 **Contact Forms** - Customizable contact forms
- ❓ **FAQ Sections** - Accordion-style FAQ sections
- 👥 **Team Section** - Team member profiles
- 💬 **Testimonials** - Customer reviews and testimonials
- 📈 **Statistics Counter** - Animated counters
- 🧭 **Breadcrumbs** - Navigation breadcrumbs

### Admin Panel Features
- 🔐 Secure authentication system
- 👤 User roles (Admin, Editor, Staff)
- 🔑 Granular permissions system
- 📱 Responsive admin interface
- 🎯 Drag & drop menu builder
- 📂 Visual media library
- ⚙️ Site-wide settings management

---

## 💻 System Requirements

- **PHP**: 8.1 or higher
- **Composer**: 2.x
- **Database**: SQLite (default) or MySQL
- **Extensions**: PDO, OpenSSL, Mbstring, Tokenizer, JSON, Fileinfo

---

## 📦 Installation

### Step 1: Clone or Download

```bash
cd /path/to/myDynamicCMS
```

### Step 2: Run Installation Script

```bash
php install.php
```

The installation script will:
- Install Composer dependencies
- Create .env file
- Generate application key
- Create SQLite database
- Run migrations
- Seed database with default data
- Set up storage symlink
- Configure permissions

### Step 3: Start Development Server

```bash
php artisan serve
```

Your CMS will be available at: `http://localhost:8000`

### Manual Installation (Alternative)

If the automatic installation fails:

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create database
touch database/database.sqlite

# Run migrations and seeders
php artisan migrate:fresh --seed

# Create storage link
php artisan storage:link

# Start server
php artisan serve
```

---

## 🎯 Quick Start

### 1. Access Admin Panel

Navigate to: `http://localhost:8000/admin`

**Default Credentials:**
- Email: `admin@example.com`
- Password: `admin123`

⚠️ **IMPORTANT**: Change the default password immediately after first login!

### 2. Create Your First Page

1. Go to **Admin Panel → Pages → Create New**
2. Enter page title (slug auto-generates)
3. Choose template type
4. Add meta description for SEO
5. Click "Create Page"

### 3. Add Dynamic Sections

1. Edit your page
2. Click "Add Section"
3. Choose section type (Hero Banner, Content, etc.)
4. Fill in section content
5. Drag to reorder sections
6. Click "Save"

### 4. Configure Menu

1. Go to **Admin Panel → Menus**
2. Select menu location (Header, Footer, Mobile)
3. Add menu items
4. Link to pages or external URLs
5. Drag to create nested menus
6. Save changes

### 5. Update Site Settings

1. Go to **Admin Panel → Settings**
2. Update site name, logo, contact info
3. Configure SEO defaults
4. Save changes

---

## 📁 Project Structure

```
myDynamicCMS/
├── assets/                    # Frontend assets (your existing design)
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript files
│   ├── img/                   # Images
│   └── fonts/                 # Fonts
│
├── cms-backend/               # Laravel CMS Backend
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/   # Admin & API controllers
│   │   │   └── Middleware/    # Authentication & permissions
│   │   └── Models/            # Database models
│   │
│   ├── config/                # Configuration files
│   ├── database/
│   │   ├── migrations/        # Database schema
│   │   └── seeders/           # Default data
│   │
│   ├── resources/
│   │   └── views/             # Admin panel views
│   │       ├── admin/         # Admin interface
│   │       └── frontend/      # Frontend templates
│   │
│   └── routes/
│       └── web.php            # Application routes
│
├── database/
│   └── database.sqlite        # SQLite database file
│
├── public/                    # Web root
│   ├── index.php              # Entry point
│   └── storage/               # Uploaded files (symlink)
│
├── storage/                   # File storage
│   ├── app/
│   │   └── public/            # Public uploads
│   ├── framework/             # Framework files
│   └── logs/                  # Application logs
│
├── .env                       # Environment configuration
├── artisan                    # Laravel CLI
├── composer.json              # PHP dependencies
├── install.php                # Installation script
└── README.md                  # This file
```

---

## 🗄️ Database Schema

### Users Table
```
users:
  - id (primary key)
  - name
  - email (unique)
  - password (hashed)
  - role (admin/editor/staff)
  - is_active
  - timestamps
```

### Pages Table
```
pages:
  - id (primary key)
  - title
  - slug (unique)
  - meta_description
  - meta_keywords
  - template
  - is_published
  - show_in_menu
  - menu_order
  - parent_id (self-referencing)
  - created_by (user_id)
  - timestamps
  - soft_deletes
```

### Page Sections Table
```
page_sections:
  - id (primary key)
  - page_id (foreign key)
  - section_type (hero_banner, rich_content, etc.)
  - order
  - content (JSON)
  - is_active
  - timestamps
```

### Menus & Menu Items
```
menus:
  - id (primary key)
  - name
  - location (header/footer/mobile)
  - timestamps

menu_items:
  - id (primary key)
  - menu_id (foreign key)
  - parent_id (self-referencing)
  - title
  - url
  - page_id (foreign key, optional)
  - target (_self/_blank)
  - order
  - is_active
  - timestamps
```

### Media Table
```
media:
  - id (primary key)
  - title
  - file_name
  - file_path
  - mime_type
  - file_size
  - type (image/document/video)
  - alt_text
  - description
  - uploaded_by (user_id)
  - timestamps
```

### Settings Table
```
settings:
  - id (primary key)
  - key (unique)
  - value
  - type (text/textarea/number/boolean/json/image)
  - group (general/seo/contact/social)
  - label
  - description
  - timestamps
```

### Roles & Permissions
```
roles:
  - id, name, display_name, description

permissions:
  - id, name, display_name, group

role_permissions:
  - role_id, permission_id

user_roles:
  - user_id, role_id
```

---

## 🎨 Admin Panel Guide

### Dashboard

The dashboard provides:
- Quick statistics (pages, media, users)
- Recent pages list
- Quick action links

### Pages Management

#### Creating a Page
1. Click **"Create New Page"**
2. Fill in:
   - **Title**: Page title (e.g., "About Us")
   - **Slug**: URL-friendly name (auto-generated or custom)
   - **Template**: Choose page template
   - **Meta Description**: SEO description
   - **Meta Keywords**: SEO keywords
   - **Parent Page**: For nested pages
   - **Menu Order**: Display order in menus
3. Toggle options:
   - **Published**: Make page live
   - **Show in Menu**: Display in navigation

#### Adding Sections to Pages
1. Edit a page
2. Click **"Add Section"**
3. Select section type
4. Fill in section-specific fields
5. Use drag handles to reorder
6. Toggle section visibility
7. Save changes

### Menu Management

#### Creating Nested Menus
1. Go to **Menus → Edit Menu**
2. Add menu item:
   - **Title**: Display text
   - **Link Type**: Page or Custom URL
   - **Page**: Select from published pages
   - **URL**: For external links
   - **Target**: Same window or new tab
3. Drag items to create hierarchy
4. Indent items to create submenus

#### Menu Locations
- **Header**: Main navigation
- **Footer**: Footer links
- **Mobile**: Mobile menu

### Media Library

#### Uploading Files
1. Go to **Media → Upload**
2. Select file (max 10MB)
3. Add metadata:
   - Title
   - Alt Text (important for SEO)
   - Description
4. Click **Upload**

#### Using Media
- Copy media URL
- Insert into page sections
- Use in settings (logos, favicons)

### Site Settings

#### General Settings
- Site Name
- Site Tagline
- Logo
- Favicon
- Footer Copyright

#### Contact Settings
- Phone Number
- Email Address
- Physical Address

#### SEO Settings
- Default Meta Description
- Default Meta Keywords

### User Management

#### Creating Users
1. Go to **Users → Create New**
2. Fill in:
   - Name
   - Email
   - Password
   - Role (Admin/Editor/Staff)
   - Active Status
3. Assign additional roles if needed

#### Editing Users
- Update profile information
- Change password
- Modify roles and permissions
- Activate/deactivate accounts

---

## 🎯 Dynamic Sections

Each section type has specific fields:

### 1. Hero Banner
```json
{
  "image": "URL to banner image",
  "title": "Main heading",
  "subtitle": "Subheading text",
  "description": "Description text",
  "cta_text": "Button text",
  "cta_link": "Button URL",
  "cta_secondary_text": "Second button text",
  "cta_secondary_link": "Second button URL"
}
```

### 2. Rich HTML Content
```json
{
  "content": "<p>HTML content with formatting</p>"
}
```

### 3. Data Table
```json
{
  "headers": ["Column 1", "Column 2", "Column 3"],
  "rows": [
    ["Data 1", "Data 2", "Data 3"],
    ["Data 4", "Data 5", "Data 6"]
  ]
}
```

### 4. Image Gallery
```json
{
  "images": [
    {
      "url": "image1.jpg",
      "title": "Image 1",
      "description": "Description"
    }
  ]
}
```

### 5. Services Grid
```json
{
  "services": [
    {
      "icon": "fas fa-icon-name",
      "title": "Service Name",
      "description": "Service description"
    }
  ]
}
```

### 6. Contact Form
```json
{
  "fields": [
    {
      "type": "text",
      "name": "name",
      "label": "Full Name",
      "required": true
    },
    {
      "type": "email",
      "name": "email",
      "label": "Email Address",
      "required": true
    }
  ],
  "submit_text": "Send Message",
  "success_message": "Thank you for contacting us!"
}
```

### 7. FAQ Section
```json
{
  "faqs": [
    {
      "question": "Question text?",
      "answer": "Answer text"
    }
  ]
}
```

### 8. Team Section
```json
{
  "members": [
    {
      "name": "John Doe",
      "position": "CEO",
      "photo": "photo.jpg",
      "bio": "Biography text",
      "social": {
        "linkedin": "URL",
        "twitter": "URL"
      }
    }
  ]
}
```

### 9. Testimonials
```json
{
  "testimonials": [
    {
      "name": "Customer Name",
      "position": "Job Title",
      "company": "Company Name",
      "photo": "photo.jpg",
      "rating": 5,
      "text": "Testimonial text"
    }
  ]
}
```

### 10. Statistics Counter
```json
{
  "stats": [
    {
      "number": "500",
      "suffix": "+",
      "label": "Happy Clients",
      "icon": "fas fa-users"
    }
  ]
}
```

### 11. Breadcrumb Navigation
```json
{
  "background_image": "image.jpg",
  "title": "Page Title",
  "show_breadcrumb": true
}
```

---

## 🎨 Frontend Integration

### Using Existing Design

Your existing HTML templates are preserved in the root directory. The CMS integrates with them through Laravel Blade templates.

### Creating Frontend Templates

1. Create a new Blade template in `cms-backend/resources/views/frontend/templates/`
2. Example: `default.blade.php`

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ $page->title }} - {{ $settings['site_name'] }}</title>
    <meta name="description" content="{{ $page->meta_description }}">

    <!-- Include your CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <!-- Header with Dynamic Menu -->
    @include('frontend.partials.header', ['menu' => $headerMenu])

    <!-- Dynamic Sections -->
    @foreach($sections as $section)
        @include('frontend.sections.' . $section->section_type, ['data' => $section->content])
    @endforeach

    <!-- Footer -->
    @include('frontend.partials.footer', ['menu' => $footerMenu])

    <!-- Include your JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
```

### Rendering Dynamic Sections

Create section partials in `cms-backend/resources/views/frontend/sections/`

Example: `hero_banner.blade.php`

```blade
<section class="hero-banner" style="background-image: url('{{ $data['image'] }}')">
    <div class="container">
        <h1>{{ $data['title'] }}</h1>
        <h5>{{ $data['subtitle'] }}</h5>
        <p>{{ $data['description'] }}</p>
        <a href="{{ $data['cta_link'] }}" class="btn btn-primary">
            {{ $data['cta_text'] }}
        </a>
    </div>
</section>
```

### Dynamic Menu Rendering

```blade
<nav class="main-menu">
    <ul>
        @foreach($menu->items as $item)
            <li>
                <a href="{{ $item->url }}" target="{{ $item->target }}">
                    {{ $item->title }}
                </a>

                @if($item->children->count() > 0)
                    <ul class="sub-menu">
                        @foreach($item->children as $child)
                            <li>
                                <a href="{{ $child->url }}" target="{{ $child->target }}">
                                    {{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
```

### Accessing Settings in Templates

```blade
<!-- Site Logo -->
<img src="{{ $settings['site_logo'] }}" alt="{{ $settings['site_name'] }}">

<!-- Contact Info -->
<p>Phone: {{ $settings['contact_phone'] }}</p>
<p>Email: {{ $settings['contact_email'] }}</p>

<!-- Footer Copyright -->
<p>{{ $settings['footer_copyright'] }}</p>
```

---

## 👥 User Roles & Permissions

### Roles

#### Administrator
- Full system access
- All permissions
- Can manage users
- Can modify system settings

#### Editor
- Can manage pages and content
- Can upload media
- Can manage menus
- Cannot access user management
- Cannot modify system settings

#### Staff
- View-only access
- Can view pages, media, and menus
- Cannot create, edit, or delete

### Permissions List

#### Pages
- `pages.view` - View pages list
- `pages.create` - Create new pages
- `pages.edit` - Edit existing pages
- `pages.delete` - Delete pages

#### Menus
- `menus.view` - View menus
- `menus.manage` - Create and edit menus

#### Media
- `media.view` - View media library
- `media.upload` - Upload files
- `media.delete` - Delete files

#### Settings
- `settings.view` - View settings
- `settings.edit` - Modify settings

#### Users
- `users.view` - View users list
- `users.create` - Create new users
- `users.edit` - Edit users
- `users.delete` - Delete users

### Custom Roles

To create custom roles, edit the database directly or create a migration:

```php
$customRole = Role::create([
    'name' => 'content_manager',
    'display_name' => 'Content Manager',
    'description' => 'Can manage all content but not users'
]);

// Assign specific permissions
$permissions = Permission::whereIn('group', ['pages', 'media', 'menus'])->get();
$customRole->permissions()->attach($permissions);
```

---

## 🔌 API Reference

### Authentication

All admin routes require authentication via session.

```php
// Check if user is authenticated
if (session('user_id')) {
    // User is logged in
}
```

### Page API

```php
// Get all published pages
$pages = Page::where('is_published', true)->get();

// Get page with sections
$page = Page::with('sections')->find($id);

// Create page
$page = Page::create([
    'title' => 'New Page',
    'slug' => 'new-page',
    'created_by' => session('user_id')
]);
```

### Menu API

```php
// Get menu with nested items
$menu = Menu::where('location', 'header')
    ->with('items.children')
    ->first();

// Create menu item
$item = MenuItem::create([
    'menu_id' => $menuId,
    'title' => 'Home',
    'url' => '/',
    'order' => 0
]);
```

### Settings API

```php
// Get setting value
$siteName = Setting::get('site_name', 'Default Name');

// Set setting value
Setting::set('site_name', 'New Name');

// Get all settings as array
$settings = Setting::pluck('value', 'key');
```

### Media API

```php
// Get all media
$media = Media::latest()->paginate(30);

// Upload file
$media = Media::create([
    'title' => $file->getClientOriginalName(),
    'file_name' => $filename,
    'file_path' => $path,
    'mime_type' => $file->getMimeType(),
    'file_size' => $file->getSize(),
    'type' => 'image',
    'uploaded_by' => session('user_id')
]);

// Get media URL
$url = $media->url; // Uses accessor
```

---

## 🎨 Customization

### Adding Custom Section Types

1. Add to `PageSection` model:

```php
const TYPE_CUSTOM = 'custom_section';

public static function getSectionTypes()
{
    return [
        // ... existing types
        self::TYPE_CUSTOM => 'Custom Section',
    ];
}
```

2. Create Blade partial: `cms-backend/resources/views/frontend/sections/custom_section.blade.php`

3. Add to admin panel section selector

### Custom Templates

1. Create template file: `cms-backend/resources/views/frontend/templates/custom.blade.php`

2. Add to template array in `PageController`:

```php
$templates = ['default', 'home', 'contact', 'about', 'team', 'custom'];
```

### Styling Admin Panel

Admin panel styles are in `cms-backend/resources/views/admin/layouts/`

Customize by editing:
- `app.blade.php` - Main layout
- `navigation.blade.php` - Sidebar menu
- Add custom CSS in `<style>` tags or external file

### Adding Custom Settings

Create a migration:

```php
Setting::create([
    'key' => 'custom_setting',
    'value' => 'default value',
    'type' => 'text',
    'group' => 'custom',
    'label' => 'Custom Setting',
    'description' => 'Description of setting'
]);
```

---

## 🐛 Troubleshooting

### Installation Issues

#### "Class not found" errors
```bash
composer dump-autoload
```

#### Database connection errors
- Check `.env` file
- Verify `database/database.sqlite` exists
- Run `php artisan migrate:fresh --seed`

#### Permission errors
```bash
chmod -R 775 storage bootstrap/cache
```

### Admin Panel Issues

#### Can't login
- Verify credentials: `admin@example.com` / `admin123`
- Check database: `php artisan tinker` → `User::first()`
- Reset password in database manually

#### Page not found (404)
- Check routes: `php artisan route:list`
- Clear cache: `php artisan cache:clear`
- Verify `.htaccess` or nginx config

#### Images not displaying
```bash
php artisan storage:link
chmod -R 775 storage
```

### Performance Issues

#### Slow page loads
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

#### Database slow queries
- Add indexes to frequently queried columns
- Use eager loading: `->with('relation')`
- Enable query logging to identify slow queries

### Common Errors

#### "CSRF token mismatch"
- Clear browser cache
- Check session configuration
- Verify session driver in `.env`

#### "Storage symlink already exists"
```bash
rm public/storage
php artisan storage:link
```

#### "Application key not set"
```bash
php artisan key:generate
```

---

## 📚 Additional Resources

### Laravel Documentation
- [Laravel Docs](https://laravel.com/docs)
- [Blade Templates](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

### Development Commands

```bash
# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Seed database
php artisan db:seed

# Create controller
php artisan make:controller NameController

# Create model
php artisan make:model ModelName -m

# Create migration
php artisan make:migration create_table_name

# Laravel tinker (interactive shell)
php artisan tinker

# List all routes
php artisan route:list
```

### Database Commands

```bash
# Fresh migration (drops all tables)
php artisan migrate:fresh

# Migrate and seed
php artisan migrate:fresh --seed

# Create database backup
sqlite3 database/database.sqlite .dump > backup.sql

# Restore database backup
sqlite3 database/database.sqlite < backup.sql
```

---

## 🤝 Contributing

This is a custom CMS built for specific needs. If you'd like to extend it:

1. Create feature branches
2. Test thoroughly
3. Document changes
4. Submit pull requests

---

## 📄 License

MIT License - Feel free to use this CMS for personal and commercial projects.

---

## 💡 Tips & Best Practices

1. **Always backup your database** before making major changes
2. **Use meaningful slugs** for SEO-friendly URLs
3. **Optimize images** before uploading (recommended: WebP format)
4. **Set proper ALT text** on images for accessibility and SEO
5. **Use caching** in production for better performance
6. **Regular security updates** - keep Laravel and dependencies updated
7. **Change default credentials** immediately after installation
8. **Test on staging** before deploying to production
9. **Use version control** (Git) for tracking changes
10. **Document custom changes** for future reference

---

## 📞 Support

For issues, questions, or feature requests:
- Check the troubleshooting section
- Review Laravel documentation
- Inspect application logs in `storage/logs/`

---

## 🎉 Getting Started Checklist

- [ ] Install dependencies (`php install.php`)
- [ ] Access admin panel (`http://localhost:8000/admin`)
- [ ] Change default password
- [ ] Update site settings (name, logo, contact info)
- [ ] Create your first page
- [ ] Add dynamic sections to your page
- [ ] Configure header menu
- [ ] Upload media (logos, images)
- [ ] Test frontend display
- [ ] Create additional user accounts
- [ ] Set up production environment
- [ ] Configure proper domain and SSL
- [ ] Set up automated backups

---

**Built with ❤️ using Laravel and SQLite**

*Version 1.0.0*
