# Custom Blocks Troubleshooting Guide

## 🔍 Blocks Not Showing in Page Builder?

Follow these steps to debug and fix the issue:

---

## ✅ Step 1: Verify Blocks Exist in Database

### Check if blocks are seeded:

```bash
php artisan tinker
```

Then run:
```php
\App\Models\CustomBlock::count();
\App\Models\CustomBlock::where('is_active', 1)->get(['id', 'name', 'category']);
```

**Expected Output:**
- Should show count > 0
- Should list your blocks

**If no blocks found:**
```bash
php artisan db:seed --class=CustomBlocksSeeder
```

---

## ✅ Step 2: Test API Endpoint

### Open your browser and navigate to:
```
http://your-domain.com/admin/custom-blocks/list
```

**Expected Response:**
```json
{
    "success": true,
    "blocks": [
        {
            "id": 1,
            "name": "Hero Banner Split",
            "icon": "fa-image",
            "color": "#667eea",
            "category": "hero",
            "html_template": "...",
            ...
        }
    ],
    "total": 10
}
```

**If you get 404 or 500 error:**
1. Clear route cache: `php artisan route:clear`
2. Check routes: `php artisan route:list | grep blocks`
3. Check permissions in routes/web.php

**If you get empty array:**
- Check database has active blocks
- Run migrations: `php artisan migrate`
- Run seeder: `php artisan db:seed --class=CustomBlocksSeeder`

---

## ✅ Step 3: Check Browser Console

### Open Page Builder and check Developer Console (F12):

**What you should see:**
```
[DynamicBlocks] 🚀 Dynamic Blocks Loader: Initializing...
[DynamicBlocks] Editor instance: Object { ... }
[DynamicBlocks] 📡 Fetching blocks from: /admin/custom-blocks/list
[DynamicBlocks] Response status: 200
[DynamicBlocks] API Response: {success: true, blocks: Array(10), total: 10}
[DynamicBlocks] 📦 Loaded 10 custom blocks: (10) [{…}, {…}, …]
[DynamicBlocks] 📝 Registering blocks with GrapesJS BlockManager...
[DynamicBlocks] Registering block: custom-block-1 {id: 1, name: "Hero Banner", …}
[DynamicBlocks] ✓ Registered: Hero Banner Split
...
[DynamicBlocks] Registration complete: 10 succeeded, 0 failed
✅ Loaded 10 custom blocks
```

### Common Console Errors:

#### Error: "GrapesJS editor not found after 20 attempts"
**Solution:**
- Check that GrapesJS is initialized BEFORE dynamic-blocks-loader.js
- Verify `window.editor = grapesjs.init({...})` exists
- Move `<script src="{{ asset('js/dynamic-blocks-loader.js') }}"></script>` to AFTER GrapesJS init

#### Error: "Failed to fetch blocks from API: 401 Unauthorized"
**Solution:**
- You need to be logged in
- Check CSRF token exists: `document.querySelector('meta[name="csrf-token"]')`
- Add to HTML head: `<meta name="csrf-token" content="{{ csrf_token() }}">`

#### Error: "BlockManager not available"
**Solution:**
- GrapesJS might not be fully initialized
- Add delay: Wait for `editor.on('load', () => { ... })`

---

## ✅ Step 4: Verify Script Loading Order

### In your blade file (builder-enhanced.blade.php or builder.blade.php):

**Correct Order:**
```html
<!-- 1. GrapesJS Core -->
<script src="https://unpkg.com/grapesjs"></script>

<!-- 2. GrapesJS Plugins -->
<script src="https://unpkg.com/grapesjs-preset-webpage"></script>

<!-- 3. Initialize GrapesJS and assign to window -->
<script>
    window.editor = grapesjs.init({
        container: '#gjs',
        // ... config
    });
</script>

<!-- 4. THEN load dynamic blocks loader -->
<script src="{{ asset('js/dynamic-blocks-loader.js') }}"></script>
```

**Wrong Order (will fail):**
```html
<!-- DON'T DO THIS -->
<script src="{{ asset('js/dynamic-blocks-loader.js') }}"></script>
<script>
    window.editor = grapesjs.init({ ... });
</script>
```

---

## ✅ Step 5: Check GrapesJS Block Panel

### In the Page Builder Interface:

1. Look for the **Blocks Panel** (usually on the left side)
2. Look for categories:
   - "Hero Sections"
   - "Sliders"
   - "Tables"
   - "Forms"
   - etc.

3. Click on a category to expand it
4. You should see your custom blocks with icons/thumbnails

### If blocks panel is empty:

**Check panel configuration:**
```javascript
// In grapesjs.init()
panels: {
    defaults: [
        {
            id: 'blocks',
            el: '.blocks-container',
            attributes: {class: 'active'}
        }
    ]
}
```

---

## ✅ Step 6: Manual Initialization (For Testing)

### Open browser console on page builder page:

```javascript
// Check if editor exists
console.log(window.editor);

// Manually initialize blocks loader
if (window.editor) {
    window.dynamicBlocksLoader = new DynamicBlocksLoader(window.editor);
}

// Check blocks
console.log(window.editor.BlockManager.getAll());
```

---

## 🔧 Quick Fixes

### Fix 1: Clear All Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Fix 2: Regenerate Blocks
```bash
# Drop and recreate tables
php artisan migrate:fresh
php artisan db:seed --class=CustomBlocksSeeder
```

### Fix 3: Check File Permissions
```bash
chmod -R 755 public/js
ls -la public/js/dynamic-blocks-loader.js
```

### Fix 4: Force Reload JavaScript
- Hard refresh browser: `Ctrl+Shift+R` (Windows) or `Cmd+Shift+R` (Mac)
- Clear browser cache
- Check if file loads: Open `http://your-domain.com/js/dynamic-blocks-loader.js` directly

---

## 📊 Verification Checklist

- [ ] Blocks exist in database (`CustomBlock::count() > 0`)
- [ ] Blocks are active (`is_active = 1`)
- [ ] API endpoint returns blocks (`/admin/custom-blocks/list`)
- [ ] CSRF token exists in HTML
- [ ] User is logged in
- [ ] GrapesJS loads successfully
- [ ] `window.editor` is defined
- [ ] dynamic-blocks-loader.js loads AFTER GrapesJS
- [ ] Console shows "Successfully loaded X blocks"
- [ ] Blocks appear in GrapesJS panel

---

## 🐛 Common Issues & Solutions

### Issue: "Blocks load but don't appear in panel"

**Cause:** Category mismatch or panel configuration issue

**Solution:**
```javascript
// Check block categories
window.editor.BlockManager.getCategories().each(cat => {
    console.log(cat.get('id'), cat.get('label'));
});

// Check blocks
window.editor.BlockManager.getAll().forEach(block => {
    console.log(block.id, block.get('category'));
});
```

### Issue: "Blocks appear but have no content when dragged"

**Cause:** Template rendering issue or missing default values

**Solution:**
- Check `html_template` field is not null
- Check `default_values` JSON is valid
- Test template: `console.log(block.html_template)`

### Issue: "Some blocks work, others don't"

**Cause:** Individual block configuration error

**Solution:**
- Check console for specific error messages
- Validate JSON fields for each block (schema, traits_config, etc.)
- Check for special characters in templates

---

## 🎯 Test with Simple Block

### Create a minimal test block:

```bash
php artisan tinker
```

```php
\App\Models\CustomBlock::create([
    'name' => 'Test Block',
    'icon' => 'fa-star',
    'color' => '#ff0000',
    'category' => 'content',
    'description' => 'Simple test block',
    'html_template' => '<div class="test-block"><h1>Test Block Works!</h1></div>',
    'css_styles' => '.test-block { padding: 20px; background: #f0f0f0; }',
    'schema' => json_encode(['fields' => []]),
    'default_values' => json_encode([]),
    'is_active' => 1
]);
```

- Reload page builder
- Look for "Test Block" in "Content Blocks" category
- Drag it to canvas
- Should see "Test Block Works!"

If this works, the system is functional and issue is with specific block configurations.

---

## 📞 Still Not Working?

### Enable Maximum Debug Mode:

1. Edit `public/js/dynamic-blocks-loader.js`
2. Set `this.debug = true;` (should already be true)
3. Check console for detailed logs

### Check Laravel Logs:
```bash
tail -f storage/logs/laravel.log
```

### Check Web Server Logs:
```bash
# Apache
tail -f /var/log/apache2/error.log

# Nginx
tail -f /var/log/nginx/error.log
```

---

## ✅ Success Indicators

When everything works correctly, you should see:

1. **In Browser Console:**
   - ✅ "Successfully loaded X blocks"
   - ✅ "Registration complete: X succeeded, 0 failed"
   - No red error messages

2. **In GrapesJS Panel:**
   - ✅ Multiple block categories
   - ✅ Blocks with icons/colors
   - ✅ Can drag blocks to canvas

3. **When Dragging Block:**
   - ✅ Block renders with content
   - ✅ Block has styles applied
   - ✅ Can edit block properties

---

## 📚 Additional Resources

- Check `DYNAMIC_BLOCKS_SETUP.md` for full setup guide
- Check `database/seeders/CustomBlocksSeeder.php` for example blocks
- Check browser Network tab for API call details
- Use `php artisan route:list` to verify routes exist

---

**Last Updated:** November 13, 2025
**Version:** 2.1.0
