# Banner and Form Components Guide

## Overview

This guide explains how to use the new separate **Banner** and **Form** components in the page builder. These components have been separated from the slider and form implementations to provide more flexibility and easier customization.

## Features

### 🎯 Banner Component

The Banner component provides a versatile way to create eye-catching banners with multiple style options.

#### Banner Styles

1. **Hero Banner** - Full-featured hero section with headline, description, and call-to-action buttons
2. **Promotional Banner** - Marketing-focused banner with special offer badge
3. **Image Banner** - Simple image-based banner with overlay text
4. **Video Banner** - Engaging video background banner

#### Customization Options

- **Banner Style**: Choose from hero, promotional, image, or video styles
- **Banner Height**: Select from small (300px), medium (400px), large (500px), or full-screen (100vh)
- **Text Position**: Align content left, center, or right
- **Dark Overlay**: Toggle dark overlay for better text readability
- **Background Image**: Customize the background image URL

#### How to Add a Banner

1. Open the page builder
2. Find the **🎯 Banners** category in the blocks panel
3. Drag the **Banner** block onto the canvas
4. Click on the banner to select it
5. Use the Settings panel on the right to customize:
   - Banner Style
   - Height
   - Text Position
   - Overlay
   - Background Image
6. Click on text elements to edit them directly

#### Example Use Cases

- **Hero Banner**: Perfect for homepage hero sections with strong CTAs
- **Promotional Banner**: Great for marketing campaigns and special offers
- **Image Banner**: Ideal for simple announcements or section headers
- **Video Banner**: Excellent for creating dynamic, engaging landing pages

---

### 📝 Form Component

The Form component offers pre-built form templates for common use cases with full customization.

#### Form Styles

1. **Contact Form** - Complete contact form with name, email, phone, and message fields
2. **Newsletter Signup** - Simple email subscription form
3. **Registration Form** - User registration with first name, last name, email, password fields
4. **Feedback Form** - Feedback collection with rating and comments

#### Customization Options

- **Form Style**: Choose from contact, newsletter, registration, or feedback
- **Form Layout**: Select centered, left-aligned, right-aligned, or split layout
- **Form Action URL**: Set the endpoint where form data will be submitted (default: `/api/form-submit`)
- **Submit Button Text**: Customize the submit button text

#### Form Layouts

- **Centered**: Form appears in the center of the page (great for standalone forms)
- **Left Aligned**: Form aligned to the left side
- **Right Aligned**: Form aligned to the right side
- **Split Layout**: Form on one side with contact information on the other (contact form only)

#### How to Add a Form

1. Open the page builder
2. Find the **📝 Forms** category in the blocks panel
3. Drag the **Form** block onto the canvas
4. Click on the form to select it
5. Use the Settings panel to customize:
   - Form Style
   - Layout
   - Action URL
   - Submit Button Text
6. Edit labels and placeholder text directly by clicking on them

#### Form Submission

All forms are configured to submit to `/api/form-submit` by default. You can:

1. Keep the default endpoint and handle submissions in your backend
2. Change the **Form Action URL** in the settings to point to your custom endpoint
3. Forms use POST method with standard form data encoding

#### Example Use Cases

- **Contact Form**: Customer inquiries, support requests, general contact
- **Newsletter**: Email list building, marketing campaigns
- **Registration**: User sign-ups, event registrations, membership forms
- **Feedback**: Customer satisfaction, product reviews, service feedback

---

## Technical Details

### File Structure

```
public/js/
└── grapes-banner-form-blocks.js    # Banner and Form component definitions
```

### Integration

The components are loaded in both builder templates:

- `resources/views/admin/pages/builder.blade.php`
- `resources/views/admin/pages/builder-enhanced.blade.php`

### Component Types

**Banner Component**: `banner-enhanced`
- Category: `🎯 Banners`
- Dynamic component that regenerates based on trait changes
- Fully editable text elements with `data-gjs-editable="true"`

**Form Component**: `form-enhanced`
- Category: `📝 Forms`
- Includes automatic form submission handler integration
- All forms are responsive and styled with Bootstrap 5

### Customization

Both components use GrapesJS traits system for customization. All changes made in the Settings panel trigger the component to regenerate with new parameters while preserving your text content.

#### Editable Elements

Elements marked with `data-gjs-editable="true"` can be edited directly:
- Headings
- Paragraphs
- Button text
- Form labels
- Contact information

---

## Best Practices

### Banner Component

1. **Use High-Quality Images**: Ensure background images are at least 1920px wide for full-screen banners
2. **Enable Overlay**: For images with complex backgrounds, enable the dark overlay for better text readability
3. **Keep Text Concise**: Hero banners work best with short, impactful headlines
4. **Test on Mobile**: Always preview your banner on tablet and mobile devices

### Form Component

1. **Set Action URL**: Make sure to configure the correct form submission endpoint
2. **Test Submissions**: Test form submissions to ensure data is being captured correctly
3. **Required Fields**: Forms include sensible defaults for required fields
4. **Privacy**: Add privacy policy links for forms collecting personal data
5. **Success Messages**: Implement success/error message handling on your backend

---

## Differences from Previous Implementation

### Previous Implementation (Slider/Form)

- Slider and form components were combined with other page elements
- Less flexibility in customization
- Required more manual configuration

### New Implementation (Banner/Form)

- ✅ Separate, dedicated components for banners and forms
- ✅ Multiple pre-built styles for quick setup
- ✅ Easy-to-use trait-based customization
- ✅ Better organized in block categories
- ✅ More intuitive "add" functionality
- ✅ Direct text editing without opening settings
- ✅ Responsive by default

---

## Troubleshooting

### Banner Not Displaying

1. Check that the background image URL is valid and accessible
2. Verify the banner height setting
3. Ensure the container has proper CSS styles

### Form Not Submitting

1. Verify the Form Action URL is correct
2. Check browser console for JavaScript errors
3. Ensure your backend endpoint accepts POST requests
4. Verify CSRF token is included if required

### Text Not Editable

1. Make sure you're clicking directly on text elements
2. Look for elements with the edit cursor icon
3. Try clicking the component first, then the text

---

## Support

For additional help or to report issues:

1. Check the main documentation: `VISUAL_BUILDER_GUIDE.md`
2. Review custom blocks documentation: `CUSTOM_BLOCKS_DOCUMENTATION.md`
3. Consult the dynamic blocks guide: `DYNAMIC_BLOCKS_GUIDE.md`

---

## Version History

- **v1.0** (2024) - Initial release with separate Banner and Form components
  - 4 banner styles (hero, promotional, image, video)
  - 4 form styles (contact, newsletter, registration, feedback)
  - Multiple layout options
  - Full trait-based customization
