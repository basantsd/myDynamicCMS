# Visual Page Builder Guide

## Overview
The Visual Page Builder uses GrapesJS with custom Treasury-specific blocks that make it easy to create beautiful pages without coding.

## How to Use

### 1. Access the Visual Builder
- Go to **Admin → Pages**
- Click **Visual Builder** button on any page
- Or create a new page and check "Use Visual Builder"

### 2. Interface Layout

#### Left Panel - Blocks
The blocks panel contains pre-built sections you can drag onto your page:

**Treasury Sections Category:**
- 🖼️ **Carousel** - Hero carousel with multiple slides
- 📥 **Downloads** - Download section with categories and files
- ⭐ **Core Values** - Value cards with icons
- 🏢 **Divisions** - Division/department boxes
- 📰 **News Cards** - News/blog cards
- 🛎️ **Services** - Service listing boxes
- 🔔 **Notices** - Public notice cards
- 👥 **Team** - Team member profile cards
- ⚡ **Quick Access** - Quick access cards
- 📇 **Contact Info** - Contact information boxes

### 3. Adding Sections

1. **Drag & Drop**: Drag a block from the left panel onto the canvas
2. **Click to Select**: Click on any element to select it
3. **Edit Content**: Double-click on text to edit it directly

### 4. Dynamic Controls (Right Panel - Settings)

When you select a Treasury section, you'll see **Add/Remove buttons** in the Settings panel:

#### Carousel Section
- **Add Slide**: Click to add a new carousel slide
- **Remove Slide**: Remove the last slide
- Each slide has:
  - Background image URL
  - Title (H1)
  - Subtitle (H5)
  - Description text
  - Two buttons

#### Download Section
- **Add Item**: Add a new download item to current category
- **Add Category**: Add a new download category
- Each item has:
  - Document title (H6)
  - File size info
  - Download button with link

#### Core Values / Divisions / News
- **Add Card**: Add a new card to the section
- **Remove Card**: Remove the last card
- Each card contains:
  - Icon (FontAwesome class)
  - Title
  - Description text

#### Service Boxes
- **Add Service**: Add a new service box
- **Remove**: Remove the last service box
- Each service has:
  - Icon
  - Service name
  - Description

#### Team Members
- **Add Member**: Add a new team member card
- **Remove**: Remove the last member
- Each member has:
  - Profile image
  - Name
  - Position
  - Bio

#### Notices
- **Add Notice**: Add a new notice card
- **Remove**: Remove the last notice
- Each notice has:
  - Badge (Important/Notice)
  - Title
  - Date
  - Content

### 5. Editing Content

**Text Content:**
1. Double-click any text to edit it
2. Or select it and use the Text toolbar

**Links & Buttons:**
1. Click on a link/button
2. Go to Settings panel (right side)
3. Find "Attributes" section
4. Edit the `href` attribute

**Icons:**
1. Click on an icon element
2. In Settings panel, find the `class` attribute
3. Change to any FontAwesome icon class
   - Example: `fas fa-star`, `fas fa-download`, `fas fa-users`
   - Browse icons at: https://fontawesome.com/icons

**Images:**
1. Click on an image
2. In Settings panel, find `src` attribute
3. Change to your image path
   - Example: `/assets/img/team/member1.jpg`

**Styling:**
1. Select any element
2. Use the Style Manager panel (right side)
3. Change colors, spacing, borders, etc.

### 6. Adding Multiple Items

**Example - Adding 5 Download Items:**
1. Drag "Downloads" block to canvas
2. Select the Downloads section
3. Click "Add Item" button **4 times** (it starts with 1 item)
4. Now you have 5 download items
5. Click each item individually to edit its content

**Example - Creating 6-Slide Carousel:**
1. Drag "Carousel" block to canvas
2. Select the Carousel section
3. Click "Add Slide" button **5 times** (starts with 1 slide)
4. Click on each slide in the canvas to edit:
   - Title
   - Subtitle
   - Description
   - Button text & links
   - Background image (in Settings panel)

### 7. Responsive Design

Use the device icons in the top toolbar to test how your page looks on:
- 🖥️ **Desktop** (default)
- 📱 **Tablet**
- 📱 **Mobile**

### 8. Saving Your Work

- **Manual Save**: Click the "Save Page" button (top right)
- **Auto-Save**: Automatically saves every 2 minutes
- **Keyboard Shortcut**: Press `Ctrl+S` (Windows) or `Cmd+S` (Mac)

### 9. Tips & Best Practices

✅ **DO:**
- Save frequently while working
- Preview your page before publishing
- Test on all device sizes
- Use consistent icon styles (all `fas` or all `far`)
- Keep text concise and readable

❌ **DON'T:**
- Add too many items to one section (keeps page fast)
- Use very large images without optimization
- Forget to add links to buttons
- Leave default placeholder text

### 10. Common Tasks

**Change Icon Color:**
1. Select the icon element
2. Style Manager → Typography → Color
3. Choose your color

**Add Spacing Between Sections:**
1. Select the section
2. Style Manager → Dimension → Padding/Margin
3. Increase top/bottom values

**Change Button Style:**
1. Select button
2. Style Manager → Decorations
3. Change background-color, border-radius, etc.

**Make Text Bold:**
1. Select text
2. Style Manager → Typography → Font Weight
3. Set to 600 or 700

### 11. FontAwesome Icon Classes

Popular icons you can use:

**General:**
- `fas fa-home` - Home
- `fas fa-info-circle` - Info
- `fas fa-star` - Star
- `fas fa-check` - Checkmark
- `fas fa-times` - X/Close

**Business:**
- `fas fa-briefcase` - Briefcase
- `fas fa-building` - Building
- `fas fa-chart-line` - Chart
- `fas fa-calculator` - Calculator
- `fas fa-coins` - Coins

**Communication:**
- `fas fa-envelope` - Email
- `fas fa-phone` - Phone
- `fas fa-comments` - Comments
- `fas fa-bell` - Notification

**Documents:**
- `fas fa-file-pdf` - PDF
- `fas fa-file-alt` - Document
- `fas fa-download` - Download
- `fas fa-upload` - Upload

**Users:**
- `fas fa-user` - Single user
- `fas fa-users` - Multiple users
- `fas fa-user-tie` - Professional
- `fas fa-id-card` - ID Card

## Need Help?

If something isn't working:
1. Check browser console for errors (F12)
2. Make sure you've saved your changes
3. Try refreshing the page
4. Contact support if the issue persists

## Advanced: Custom HTML

If you need something not available in blocks:
1. Drag a "Custom Code" block from the Basic category
2. Double-click to edit the HTML
3. Add your custom code
