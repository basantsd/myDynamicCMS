# Quick Start Guide - DynamicCMS

## 🚀 Get Started in 5 Minutes

### Step 1: Install (1 minute)

```bash
php install.php
```

This automatically:
- Installs dependencies
- Sets up database
- Creates admin user
- Configures application

### Step 2: Start Server (10 seconds)

```bash
php artisan serve
```

### Step 3: Login (30 seconds)

Visit: http://localhost:8000/admin

**Login Credentials:**
- Email: `admin@example.com`
- Password: `admin123`

⚠️ **Change password immediately after login!**

### Step 4: Create First Page (2 minutes)

1. Click **"Pages"** → **"Create New"**
2. Enter title: "Home"
3. Select template: "home"
4. Check "Published"
5. Click **"Create"**

### Step 5: Add Content Section (2 minutes)

1. On your page editor, click **"Add Section"**
2. Choose **"Hero Banner"**
3. Fill in:
   - Image URL: Upload from media or paste URL
   - Title: "Welcome to Our Site"
   - Subtitle: "Making content management easy"
   - Description: "Your description here"
   - CTA Text: "Learn More"
   - CTA Link: "#"
4. Click **"Save Section"**

### Step 6: View Your Page

Visit: http://localhost:8000/home

🎉 **You're done!** Your dynamic CMS is ready.

---

## Next Steps

### Update Site Settings
1. Go to **Settings**
2. Update:
   - Site Name
   - Logo (upload via Media Library)
   - Contact Information
3. Save changes

### Create Menu
1. Go to **Menus** → **Edit Header Menu**
2. Click **"Add Item"**
3. Link to your "Home" page
4. Add more menu items
5. Drag to create nested menus

### Add More Pages
- About Us
- Contact
- Services
- Team

### Upload Media
1. Go to **Media Library**
2. Click **"Upload"**
3. Select images/files
4. Add ALT text for SEO
5. Copy URLs to use in sections

---

## Common First Tasks

### Change Admin Password
1. **Users** → Find your account
2. Click **Edit**
3. Enter new password
4. Confirm password
5. Save

### Create New User
1. **Users** → **"Create New"**
2. Fill in details
3. Choose role:
   - **Admin**: Full access
   - **Editor**: Content management
   - **Staff**: View only
4. Save

### Make Page Homepage
1. Edit page
2. Set slug to: `home`
3. Or configure in routes

---

## Available Section Types

1. **Hero Banner** - Full-width hero with CTA
2. **Rich Content** - WYSIWYG text editor
3. **Image Gallery** - Photo gallery
4. **Services Grid** - Services/features showcase
5. **Team Section** - Team member profiles
6. **Testimonials** - Customer reviews
7. **FAQ** - Accordion FAQs
8. **Contact Form** - Customizable form
9. **Data Table** - Responsive tables
10. **Statistics** - Animated counters
11. **Breadcrumb** - Navigation breadcrumbs

---

## Tips for Success

✅ **DO:**
- Backup database regularly
- Optimize images before upload
- Use descriptive slugs
- Add meta descriptions for SEO
- Test changes before publishing

❌ **DON'T:**
- Use default credentials in production
- Upload huge files (10MB max)
- Forget to add ALT text to images
- Skip backups

---

## Troubleshooting

### Can't login?
- Check credentials: admin@example.com / admin123
- Run: `php artisan db:seed --class=UserSeeder`

### Page not loading?
- Check if page is published
- Verify URL slug
- Run: `php artisan route:clear`

### Images not showing?
- Run: `php artisan storage:link`
- Check file permissions: `chmod -R 775 storage`

### Need to reset?
```bash
php artisan migrate:fresh --seed
```

---

## Support

📖 **Full Documentation**: See README.md
🐛 **Issues**: Check application logs in `storage/logs/`
💡 **Laravel Help**: https://laravel.com/docs

---

Happy content managing! 🎉
