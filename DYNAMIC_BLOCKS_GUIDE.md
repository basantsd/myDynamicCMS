# Dynamic Custom Blocks System - Complete Guide

## Overview

The Dynamic Custom Blocks system provides a powerful, flexible way to create and manage content blocks with advanced features including:

- **Dynamic JSON-based schemas** for flexible block structures
- **Drag & drop reordering** for easy page building
- **CSV import/export** for table data
- **Form submission tracking** with multiple form types
- **Color-coded blocks** for visual organization
- **Advanced slider controls** with autoplay and transitions
- **Interactive table editing** with add/remove columns
- **Button actions** (view, download, redirect with targets)
- **Multiple block types** usable on the same page

## Features by Block Type

### 1. Slider Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-images

**Features:**
- Multiple slides with individual content
- Autoplay with custom intervals
- Transition effects (slide, fade, zoom)
- Navigation styles (arrows, dots, both)
- Image uploads for each slide
- Slide-specific CTAs

**Advanced Settings:**
```json
{
  "autoplay": true,
  "interval": 5,
  "transition": "slide",
  "navigation_style": "both"
}
```

### 2. Table Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-table

**Features:**
- CSV import for bulk data
- Add/remove columns dynamically
- Inline cell editing
- Export to CSV
- Table styles (default, striped, bordered, hover)
- Sortable columns
- Manual data entry

**API Endpoints:**
```
POST /admin/page-sections/{id}/import-csv
POST /admin/page-sections/{id}/table/add-column
DELETE /admin/page-sections/{id}/table/remove-column
PUT /admin/page-sections/{id}/table/update-cell
GET /admin/page-sections/{id}/table/export-csv
```

### 3. Form Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-envelope

**Features:**
- Three form types:
  - **Submission**: Store form data
  - **Calculation**: Perform calculations
  - **Action**: Trigger actions
- Dynamic form fields (text, email, tel, textarea, select)
- Form submissions tracking
- Export submissions to CSV
- View submission statistics

**Form Types:**

1. **Submission Forms**:
   - Contact forms
   - Registration forms
   - Feedback forms
   - Stored in `form_submissions` table

2. **Calculation Forms**:
   - Loan calculators
   - BMI calculators
   - Tax calculators
   - Results calculated and stored

3. **Action Forms**:
   - Newsletter signup
   - Appointment booking
   - Event registration
   - Triggers specific actions

**Form Submission Endpoints:**
```
POST /api/form-submit (Public)
GET /admin/form-submissions
GET /admin/form-submissions/form/{formName}
GET /admin/form-submissions/export/{formName}
GET /admin/form-submissions/statistics
```

### 4. Button Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-hand-pointer

**Features:**
- Multiple button styles (primary, secondary, outline, success, danger)
- Button sizes (small, medium, large)
- Action types:
  - **Link**: Standard navigation
  - **Download**: File downloads
  - **Redirect**: Page redirects
- Target options (_self, _blank)
- Button alignment (left, center, right)
- Multiple buttons per block

### 5. List Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-list

**Features:**
- Icon-based lists
- Repeatable list items
- Custom icons per item
- Nested lists support
- Multiple list styles

### 6. Hero Blocks
**Color:** Dynamic (customizable)
**Icon:** fa-image, fa-video, etc.

**8 Pre-configured Templates:**
1. Hero with Background Image
2. Hero with Video Background
3. Hero with Image Slider
4. Hero Split Layout
5. Hero with Statistics Table
6. Hero with Contact Form
7. Minimal Hero
8. Hero with Icon Features

## Database Structure

### Custom Blocks Table
```sql
- id
- name
- icon (FontAwesome class)
- color (Hex color for visual identification)
- category (slider, table, form, button, list, hero, etc.)
- description
- preview_image
- schema (JSON - block structure definition)
- advanced_features (JSON - slider settings, table settings, etc.)
- action_settings (JSON - button actions, redirects, etc.)
- default_values (JSON)
- form_table_name (for forms that create dedicated tables)
- is_active
- usage_count
```

### Form Submissions Table
```sql
- id
- page_id
- page_section_id
- form_name
- form_type (submission, calculation, action)
- form_data (JSON - submitted data)
- calculated_result (JSON - for calculation forms)
- ip_address
- user_agent
- submitted_at
```

### Page Sections Table (Enhanced)
```sql
- id
- page_id
- section_type
- name (block identifier)
- custom_block_id (reference to custom block template)
- order
- content (JSON - block data)
- is_active
```

## Usage Guide

### Adding a Block to a Page

1. **Navigate to Page Editor**
   - Go to Admin → Pages → Edit Page
   - Click "Visual Page Builder" tab

2. **Select Block from Picker**
   - Browse blocks by category
   - Search by name or description
   - Click "Add" button on desired block

3. **Fill Block Form**
   - Enter block name (optional but recommended)
   - Fill required fields
   - Configure advanced settings
   - Upload images/files as needed

4. **Special Features by Type:**

   **For Sliders:**
   - Add multiple slides
   - Configure autoplay and interval
   - Set transition effects

   **For Tables:**
   - Import CSV file OR
   - Manually add columns and rows
   - Style the table

   **For Forms:**
   - Add form fields
   - Select form type
   - Configure submission behavior

   **For Buttons:**
   - Set button text and URL
   - Choose action type
   - Set target window

5. **Save and Position**
   - Click "Add Block" button
   - Drag block to desired position
   - Blocks can be reordered anytime

### Editing Existing Blocks

1. Hover over block in Visual Page Builder
2. Click "Edit" button
3. Modify fields in modal
4. Click "Update Block"

### Managing Table Data

**Import CSV:**
```javascript
// In block editor
1. Click "Import CSV" button
2. Select CSV file
3. Data automatically populates table
```

**Add Column:**
```javascript
POST /admin/page-sections/{id}/table/add-column
{
  "column_name": "New Column",
  "default_value": ""
}
```

**Edit Cell:**
```javascript
PUT /admin/page-sections/{id}/table/update-cell
{
  "row_index": 0,
  "column_index": 2,
  "value": "Updated Value"
}
```

### Viewing Form Submissions

**Via Admin Interface:**
1. Go to Admin → Form Submissions
2. Filter by form name, type, or date
3. Export to CSV

**Via API:**
```javascript
// Get all submissions for a form
GET /admin/form-submissions/form/contact-form

// Get statistics
GET /admin/form-submissions/statistics

// Export submissions
GET /admin/form-submissions/export/contact-form
```

### Frontend Form Submission

```javascript
// Submit form from frontend
fetch('/api/form-submit', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({
    page_id: 1,
    form_name: 'contact-form',
    form_type: 'submission',
    form_data: {
      name: 'John Doe',
      email: 'john@example.com',
      message: 'Hello!'
    }
  })
})
.then(response => response.json())
.then(data => {
  if (data.success) {
    console.log('Form submitted successfully');
    if (data.calculated_result) {
      console.log('Calculation result:', data.calculated_result);
    }
  }
});
```

## Block Schema Examples

### Slider Block Schema
```json
{
  "fields": [
    {
      "name": "slides",
      "type": "repeater",
      "label": "Slides",
      "fields": [
        { "name": "image", "type": "image", "label": "Image", "required": true },
        { "name": "heading", "type": "text", "label": "Heading" },
        { "name": "description", "type": "textarea", "label": "Description" },
        { "name": "button", "type": "button", "label": "CTA Button" }
      ]
    }
  ]
}
```

### Table Block Schema
```json
{
  "fields": [
    {
      "name": "table_data",
      "type": "table",
      "label": "Table Data",
      "fields": [
        { "name": "headers", "type": "array", "label": "Headers" },
        { "name": "rows", "type": "repeater", "label": "Rows" }
      ]
    },
    {
      "name": "table_style",
      "type": "select",
      "label": "Table Style",
      "options": ["default", "striped", "bordered", "hover"]
    }
  ]
}
```

### Form Block Schema
```json
{
  "fields": [
    { "name": "form_title", "type": "text", "label": "Form Title" },
    {
      "name": "form_fields",
      "type": "repeater",
      "label": "Form Fields",
      "fields": [
        {
          "name": "type",
          "type": "select",
          "label": "Field Type",
          "options": ["text", "email", "tel", "textarea", "select"]
        },
        { "name": "label", "type": "text", "label": "Label" },
        { "name": "required", "type": "toggle", "label": "Required" }
      ]
    },
    {
      "name": "form_type",
      "type": "select",
      "label": "Form Type",
      "options": ["submission", "calculation", "action"]
    }
  ]
}
```

## Visual Page Builder Interface

### Page Editor Tabs
1. **Page Settings** - Basic page info, meta tags, status
2. **Visual Page Builder** - Block management interface

(Section Builder has been removed and integrated into Visual Page Builder)

### Block Picker Panel
- Left sidebar with all available blocks
- Grouped by category
- Color-coded for visual identification
- Shows icon, name, description, usage count
- Search and filter functionality

### Block Management Area
- Center area showing all added blocks
- Drag handle for reordering
- Block header with:
  - Icon and name
  - Category badge
  - Edit, Duplicate, Delete buttons
- Block preview showing content
- "Add Block Above" button on hover

### Block Interaction
1. **Hover**: Shows "Add Block Above" button
2. **Drag**: Reorder blocks
3. **Click Edit**: Opens block form modal
4. **Click Duplicate**: Creates copy of block
5. **Click Delete**: Removes block (with confirmation)

## Styling and Customization

### Block Colors
Each block type has a custom color for visual identification:
- **Slider**: #9b59b6 (Purple)
- **Table**: #e74c3c (Red)
- **Form**: #3498db (Blue)
- **Button**: #f39c12 (Orange)
- **List**: #1abc9c (Turquoise)
- **Hero**: #2ecc71 (Green)

Colors are used for:
- Border-left on block picker
- Icon color
- Category badge background
- Block header gradient

### CSS Classes
```css
.block-template - Block in picker
.page-block - Block in builder
.block-header - Block header area
.block-preview - Block content preview
.block-drag-handle - Drag & drop handle
.repeater-field - Repeating field group
.table-field - Table editor
.button-field - Button configuration
```

## JavaScript API

### Initialize Builder
```javascript
const visualPageBuilder = new VisualPageBuilder(pageId);
```

### Methods
```javascript
// Open block form
visualPageBuilder.openBlockForm(blockTemplateId);

// Edit existing block
visualPageBuilder.editBlock(blockId);

// Delete block
visualPageBuilder.deleteBlock(blockId);

// Duplicate block
visualPageBuilder.duplicateBlock(blockId);

// Save block
visualPageBuilder.saveBlock(templateId, blockId);

// Import CSV to table
visualPageBuilder.importCSV(fileInput);

// Add table column
visualPageBuilder.addTableColumn();

// Export table as CSV
visualPageBuilder.exportTableAsCSV();

// View form submissions
visualPageBuilder.viewFormSubmissions();
```

## Best Practices

1. **Block Naming**: Always provide meaningful names for blocks
2. **Table Data**: Use CSV import for large datasets
3. **Forms**: Choose appropriate form type for your use case
4. **Buttons**: Use descriptive text and appropriate action types
5. **Sliders**: Optimize images for web before uploading
6. **Reusability**: Create custom block templates for frequently used patterns

## Troubleshooting

### Common Issues

**Block not saving:**
- Check all required fields are filled
- Verify file uploads are under size limit
- Check browser console for errors

**CSV import fails:**
- Ensure CSV is properly formatted
- Check for special characters
- Verify file size is under 10MB

**Form submissions not recorded:**
- Verify form_name is set
- Check network tab for API errors
- Ensure CSRF token is present

**Drag & drop not working:**
- Clear browser cache
- Check Sortable.js is loaded
- Verify no JavaScript errors

## Future Enhancements

Planned features:
- Visual schema builder for custom blocks
- Block templates export/import
- AI-powered block suggestions
- Version control for blocks
- Block performance analytics
- Collaborative editing
- Mobile-optimized block builder

## Support

For issues or questions:
- Check documentation
- View example implementations
- Contact support team
