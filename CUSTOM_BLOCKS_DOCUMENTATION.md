# Custom Dynamic Hero Blocks System

## Overview

The Custom Blocks system allows you to create, manage, and reuse dynamic hero sections and content blocks throughout your CMS. Each block is defined with a JSON schema that determines its structure and fields.

## Features

- **Dynamic JSON-based configuration** - Define block structure with flexible schemas
- **Reusable templates** - Create blocks once, use them across multiple pages
- **Search & filtering** - Find blocks by name, category, or description
- **Icon integration** - Each block displays with a FontAwesome icon
- **Usage tracking** - Monitor how many times each block is used
- **Category organization** - Group blocks by type (hero, content, media, form, feature)

## Database Structure

### Custom Blocks Table
```
- id: Unique identifier
- name: Block name (searchable)
- icon: FontAwesome icon class (e.g., "fa-image", "fa-video")
- category: Block category (hero, content, media, form, feature)
- description: Block description (searchable)
- preview_image: Optional thumbnail URL
- schema: JSON schema defining block structure
- default_values: Default field values
- is_active: Whether block is available for use
- usage_count: Number of times block is used
```

### Page Sections Enhancement
```
- custom_block_id: Reference to custom block template
- name: Section name for identification
```

## API Endpoints

### List All Blocks (Admin)
```
GET /admin/custom-blocks
Parameters:
  - search: Search term (name, description, category)
  - category: Filter by category
  - active: Only active blocks
  - sort: Sort field (name, usage)
  - order: Sort order (asc, desc)
```

### Get Block Picker List
```
GET /admin/custom-blocks/list
Parameters:
  - search: Search term
  - category: Filter by category
Returns: All active blocks sorted by usage count
```

### Create Block
```
POST /admin/custom-blocks
Body:
  - name: string (required)
  - icon: string (required, FontAwesome class)
  - category: string (required)
  - description: string
  - schema: object (required)
  - default_values: object
  - preview_image: string
  - is_active: boolean
```

### Update Block
```
PUT /admin/custom-blocks/{id}
Body: Same as create
```

### Delete Block
```
DELETE /admin/custom-blocks/{id}
Note: Cannot delete blocks that are in use (usage_count > 0)
```

### Toggle Active Status
```
POST /admin/custom-blocks/{id}/toggle
```

### Duplicate Block
```
POST /admin/custom-blocks/{id}/duplicate
Creates a copy with "(Copy)" suffix, starts as inactive
```

## Block Schema Format

### Example Schema Structure
```json
{
  "fields": [
    {
      "name": "heading",
      "type": "text",
      "label": "Heading",
      "required": true
    },
    {
      "name": "background_image",
      "type": "image",
      "label": "Background Image",
      "required": false
    },
    {
      "name": "buttons",
      "type": "repeater",
      "label": "Buttons",
      "fields": [
        {
          "name": "text",
          "type": "text",
          "label": "Button Text",
          "required": true
        },
        {
          "name": "url",
          "type": "text",
          "label": "Button URL",
          "required": true
        }
      ]
    }
  ]
}
```

### Supported Field Types

1. **text** - Single line text input
2. **textarea** - Multi-line text input
3. **wysiwyg** - Rich text editor
4. **image** - Image upload/select
5. **video** - Video upload/URL
6. **color** - Color picker
7. **number** - Numeric input
8. **range** - Slider input (requires min, max)
9. **select** - Dropdown (requires options array)
10. **toggle** - On/off switch
11. **icon** - Icon picker
12. **button** - Button configuration (text, url, style)
13. **repeater** - Repeating field group (requires fields array)
14. **table** - Table data structure

## Default Hero Block Templates

The system includes 8 pre-configured hero block templates:

### 1. Hero with Background Image
**Icon:** `fa-image`
**Features:** Background image, heading, subheading, description, dual CTA buttons

### 2. Hero with Video Background
**Icon:** `fa-video`
**Features:** Video background, poster image, overlay opacity control, heading, description, CTA

### 3. Hero with Image Slider
**Icon:** `fa-images`
**Features:** Multi-slide carousel with autoplay, individual slide content and CTAs

### 4. Hero Split Layout
**Icon:** `fa-columns`
**Features:** Split screen with image and content, configurable image position, feature list, multiple CTAs

### 5. Hero with Statistics Table
**Icon:** `fa-table`
**Features:** Data table integration, customizable headers and rows, multiple table styles

### 6. Hero with Call-to-Action Form
**Icon:** `fa-envelope`
**Features:** Integrated contact form, customizable form fields, background image

### 7. Minimal Hero
**Icon:** `fa-heading`
**Features:** Clean centered design, background color control, minimal content

### 8. Hero with Icon Features
**Icon:** `fa-star`
**Features:** Icon-based features grid, background support, feature descriptions

## Using Custom Blocks

### Creating a Page Section with Custom Block

```javascript
// Example API request
POST /admin/page-sections
{
  "page_id": 1,
  "section_type": "hero_banner",
  "name": "Homepage Hero",
  "custom_block_id": 5,  // Optional: Use predefined block
  "content": {
    "heading": "Welcome to Our Site",
    "background_image": "/images/hero-bg.jpg",
    "primary_button": {
      "text": "Get Started",
      "url": "/signup",
      "style": "primary"
    }
  }
}
```

### When Using a Custom Block:
- The system automatically merges `default_values` with your `content`
- Usage count is automatically incremented
- Block schema provides validation structure

## Search & Discovery

### Search by Name
```
GET /admin/custom-blocks/list?search=hero+background
```

### Filter by Category
```
GET /admin/custom-blocks/list?category=hero
```

### Sort by Popularity
```
GET /admin/custom-blocks?sort=usage&order=desc
```

## Best Practices

1. **Use Descriptive Names**: Name blocks clearly (e.g., "Hero with Background Image and Dual CTAs")
2. **Choose Appropriate Icons**: Select icons that visually represent the block type
3. **Provide Descriptions**: Help users understand when to use each block
4. **Set Sensible Defaults**: Include useful default values to speed up content creation
5. **Test Before Activating**: Create blocks as inactive, test them, then activate
6. **Use Categories Wisely**: Group similar blocks together for easier discovery
7. **Update Preview Images**: Add preview images to help users visualize blocks

## Frontend Integration

When rendering pages, page sections include their custom block reference:

```php
// In your frontend controller
$section = PageSection::with('customBlock')->find($id);

// Access block schema and content
$blockSchema = $section->customBlock->schema;
$sectionContent = $section->content;
$blockName = $section->customBlock->name;
$blockIcon = $section->customBlock->icon;
```

## Migration Commands

```bash
# Run migrations
php artisan migrate

# Seed default custom blocks
php artisan db:seed --class=CustomBlockSeeder

# Or seed entire database
php artisan db:seed
```

## Future Enhancements

Potential additions to the custom blocks system:
- Block preview rendering
- Block templates export/import
- Version control for blocks
- Block analytics and performance tracking
- Visual schema builder
- AI-powered block suggestions
