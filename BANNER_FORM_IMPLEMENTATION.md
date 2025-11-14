# Banner and Form Database Implementation Guide

## Overview

This implementation creates **database-driven Banners and Forms** that can be managed from the admin panel and used in the GrapesJS page builder.

## What Has Been Created

### 1. Database Migrations

#### Banners Table (`2024_01_01_000010_create_banners_table.php`)
- **name**: Banner name for admin reference
- **title**: Banner heading/title
- **description**: Banner description/subtitle
- **image**: Background image path
- **video_url**: Video URL for video banners
- **Button Configuration**:
  - `button_text`, `button_url`, `button_action` (link/redirect/download/modal/scroll)
  - `button_target` (_self/_blank)
  - `button_style` (primary/secondary/success/etc)
  - Secondary button fields (`button_text_2`, `button_url_2`, etc.)
- **Styling**:
  - `banner_type`: hero, promotional, image, video, slider
  - `height`: Banner height (300px, 500px, 100vh, etc)
  - `text_position`: left, center, right
  - `show_overlay`: Boolean for dark overlay
  - `overlay_color`: Overlay color (rgba)
  - `text_color`: Text color
- **Slider Configuration** (when `banner_type` is 'slider'):
  - `slides`: JSON array of slide objects
  - `autoplay`: Boolean
  - `interval`: Seconds between slides
  - `transition`: slide/fade/zoom
- **custom_css**, **custom_js**: Additional customization
- **is_active**, **sort_order**: Status and ordering

#### Forms Table (`2024_01_01_000011_create_forms_table.php`)
- **name**: Form name for admin reference
- **title**: Form heading
- **description**: Form description
- **Form Type**: submission, calculation, or action
- **Fields Configuration** (JSON):
  ```json
  [
    {
      "name": "email",
      "type": "email",
      "label": "Email Address",
      "placeholder": "Enter your email",
      "required": true,
      "validation": "email|required",
      "default_value": "",
      "help_text": "We'll never share your email"
    }
  ]
  ```
- **Calculation Configuration** (JSON) - for calculation forms:
  ```json
  {
    "formula": "field1 + field2 * field3",
    "result_field": "total",
    "result_label": "Total Amount",
    "calculation_type": "sum|average|custom",
    "fields_to_calculate": ["field1", "field2"],
    "custom_formula": "field1 * 0.1 + field2"
  }
  ```
- **Action Configuration** (JSON) - for action forms:
  ```json
  {
    "action_type": "email|api|webhook",
    "email_to": "admin@example.com",
    "api_url": "https://api.example.com/endpoint",
    "webhook_url": "https://webhook.example.com",
    "headers": {"Authorization": "Bearer token"}
  }
  ```
- **Styling**:
  - `layout`: centered, left, right, split, inline
  - `submit_button_text`, `submit_button_style`
  - `form_width`, `background_color`
- **Email Notifications**:
  - `send_email_notification`, `notification_email`
  - `notification_subject`, `notification_template`
- **Auto-responder**:
  - `send_auto_response`
  - `auto_response_subject`, `auto_response_template`
  - `auto_response_email_field`
- **Settings**:
  - `store_submissions`: Store in database
  - `enable_captcha`: Enable CAPTCHA
- **custom_css**, **custom_js**: Additional customization

#### Form Submissions Table
- `form_id`: Foreign key to forms
- `data`: JSON of submitted data
- `ip_address`, `user_agent`
- `user_id`: If user was logged in

### 2. Models

#### Banner Model (`app/Models/Banner.php`)
- Relationships and scopes (active, ordered)
- **HTML Generation Methods**:
  - `generateHtml()`: Main method that calls specific type methods
  - `generateHeroHtml()`: Hero banner HTML
  - `generatePromotionalHtml()`: Promotional banner HTML
  - `generateImageHtml()`: Image banner HTML
  - `generateVideoHtml()`: Video banner HTML
  - `generateSliderHtml()`: Slider/carousel HTML

#### Form Model (`app/Models/Form.php`)
- Relationships with FormSubmission
- **HTML Generation Methods**:
  - `generateHtml()`: Main form HTML
  - `generateFieldHtml()`: Individual field HTML based on type
  - `generateCalculationScript()`: JavaScript for calculation forms
- **Supported Field Types**:
  - text, textarea, email, tel, url, number
  - select, checkbox, radio
  - file

#### FormSubmission Model (`app/Models/FormSubmission.php`)
- Stores submitted form data
- Relationships with Form and User

### 3. Controllers

#### BannerController (`app/Http/Controllers/Admin/BannerController.php`)
- **CRUD Operations**: index, create, store, edit, update, destroy
- **API Endpoint**: `list()` - Returns all active banners with generated HTML for page builder

#### FormController (`app/Http/Controllers/Admin/FormController.php`)
- **CRUD Operations**: index, create, store, edit, update, destroy
- **API Endpoint**: `list()` - Returns all active forms with generated HTML for page builder
- **Submission Handling**: `submit()` - Handles form submissions with validation
- **View Submissions**: `submissions()` - View form submissions

## What Needs to Be Done Next

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Add Routes (`routes/web.php`)
```php
// Banner routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::resource('banners', BannerController::class);
    Route::get('banners-list', [BannerController::class, 'list'])->name('banners.list');

    Route::resource('forms', FormController::class);
    Route::get('forms-list', [FormController::class, 'list'])->name('forms.list');
    Route::get('forms/{form}/submissions', [FormController::class, 'submissions'])->name('forms.submissions');
});

// Public form submission endpoint
Route::post('/api/form-submit', [FormController::class, 'submit'])->name('form.submit');
```

### 3. Create Admin Views

You need to create views for managing banners and forms:

#### Banner Views
- `resources/views/admin/banners/index.blade.php` - List all banners
- `resources/views/admin/banners/create.blade.php` - Create new banner
- `resources/views/admin/banners/edit.blade.php` - Edit banner

#### Form Views
- `resources/views/admin/forms/index.blade.php` - List all forms
- `resources/views/admin/forms/create.blade.php` - Create new form
- `resources/views/admin/forms/edit.blade.php` - Edit form
- `resources/views/admin/forms/submissions.blade.php` - View form submissions

### 4. Integrate into Page Builder

Add JavaScript to load banners and forms into GrapesJS:

```javascript
// In your page builder JavaScript file

// Load Banners
async function loadBanners() {
    try {
        const response = await fetch('/admin/banners-list');
        const data = await response.json();

        if (data.success) {
            data.banners.forEach(banner => {
                editor.BlockManager.add(`banner-${banner.id}`, {
                    label: banner.name,
                    category: '🎯 Banners',
                    content: banner.html,
                    media: '<i class="fas fa-image"></i>'
                });
            });
        }
    } catch (error) {
        console.error('Error loading banners:', error);
    }
}

// Load Forms
async function loadForms() {
    try {
        const response = await fetch('/admin/forms-list');
        const data = await response.json();

        if (data.success) {
            data.forms.forEach(form => {
                editor.BlockManager.add(`form-${form.id}`, {
                    label: form.name,
                    category: '📝 Forms',
                    content: form.html,
                    media: '<i class="fas fa-wpforms"></i>'
                });
            });
        }
    } catch (error) {
        console.error('Error loading forms:', error);
    }
}

// Call these functions after GrapesJS initialization
editor.on('load', function() {
    loadBanners();
    loadForms();
});
```

## Banner Types Explained

### 1. Hero Banner
- Full-featured hero section
- Title, description, and up to 2 CTA buttons
- Configurable text position and overlay

### 2. Promotional Banner
- Marketing-focused banner
- Includes "SPECIAL OFFER" badge
- Image on right side
- Single CTA button

### 3. Image Banner
- Simple image with text overlay
- Minimal design
- Good for section headers

### 4. Video Banner
- Video background
- Autoplay, muted, looping video
- Text overlay with CTA

### 5. Slider Banner
- Multiple slides in carousel
- Each slide has image, title, description
- Configurable autoplay and transition effects

## Form Types Explained

### 1. Submission Form
- Standard data collection
- Data stored in `form_submissions` table
- Optional email notifications

### 2. Calculation Form
- Performs client-side calculations
- Supports: sum, average, custom formulas
- Example: loan calculator, price estimator
- Formula example: `field1 * 0.1 + field2`

### 3. Action Form
- Triggers specific actions on submission
- Can send to external APIs
- Webhook integration
- Custom headers for authentication

## Field Types Supported

- **text**: Single-line text input
- **textarea**: Multi-line text
- **email**: Email with validation
- **tel**: Phone number
- **url**: URL input
- **number**: Numeric input (supports min, max, step)
- **select**: Dropdown with options
- **checkbox**: Single checkbox
- **radio**: Radio button group
- **file**: File upload

## Field Configuration Example

```json
{
  "name": "amount",
  "type": "number",
  "label": "Loan Amount",
  "placeholder": "Enter amount",
  "required": true,
  "validation": "required|numeric|min:1000|max:1000000",
  "default_value": "10000",
  "help_text": "Minimum $1,000",
  "min": 1000,
  "max": 1000000,
  "step": 1000
}
```

## Calculation Form Example

For a simple loan calculator:

**Fields:**
```json
[
  {"name": "principal", "type": "number", "label": "Loan Amount", "required": true},
  {"name": "rate", "type": "number", "label": "Interest Rate (%)", "required": true, "step": "0.1"},
  {"name": "years", "type": "number", "label": "Loan Term (years)", "required": true},
  {"name": "monthly_payment", "type": "number", "label": "Monthly Payment", "readonly": true}
]
```

**Calculation Config:**
```json
{
  "calculation_type": "custom",
  "custom_formula": "(principal * (rate/100/12) * Math.pow(1 + rate/100/12, years*12)) / (Math.pow(1 + rate/100/12, years*12) - 1)",
  "result_field": "monthly_payment",
  "result_label": "Monthly Payment"
}
```

## Next Steps Summary

1. ✅ Run migrations: `php artisan migrate`
2. ✅ Add routes to `routes/web.php`
3. ⏳ Create admin views for banners (index, create, edit)
4. ⏳ Create admin views for forms (index, create, edit, submissions)
5. ⏳ Integrate into page builder JavaScript
6. ⏳ Test banner creation and usage
7. ⏳ Test form creation and submission
8. ⏳ Implement email notifications (optional)
9. ⏳ Add form validation and error handling

## Benefits of This Implementation

- ✅ **Database-driven**: All banners and forms stored in database
- ✅ **Reusable**: Create once, use multiple times across pages
- ✅ **Dynamic**: Generate HTML on-the-fly based on configuration
- ✅ **Flexible**: Support for multiple banner and form types
- ✅ **Calculation Support**: Built-in calculation forms
- ✅ **Validation**: Field-level validation
- ✅ **Submission Tracking**: Store and view form submissions
- ✅ **Admin Management**: Full CRUD from admin panel
- ✅ **Page Builder Integration**: Drag and drop into GrapesJS

---

This implementation provides a solid foundation for managing banners and forms. The next step is to create the admin views and integrate the loading functions into your page builder!
