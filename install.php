<?php

/**
 * DynamicCMS Installation Script
 *
 * This script will set up your CMS installation
 */

echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║            DynamicCMS Installation Script                     ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

// Check PHP version
if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    die("❌ PHP 8.1 or higher is required. Your version: " . PHP_VERSION . "\n");
}
echo "✓ PHP Version: " . PHP_VERSION . "\n";

// Check Composer
if (!file_exists('vendor/autoload.php')) {
    echo "\n📦 Installing Composer dependencies...\n";
    exec('composer install', $output, $return);
    if ($return !== 0) {
        die("❌ Failed to install Composer dependencies. Run 'composer install' manually.\n");
    }
    echo "✓ Composer dependencies installed\n";
}

// Create .env file
if (!file_exists('.env')) {
    echo "\n📝 Creating .env file...\n";
    copy('.env.example', '.env');
    echo "✓ .env file created\n";
}

// Generate application key
echo "\n🔑 Generating application key...\n";
require_once 'vendor/autoload.php';
$key = 'base64:' . base64_encode(random_bytes(32));
$env = file_get_contents('.env');
$env = preg_replace('/APP_KEY=.*/', 'APP_KEY=' . $key, $env);
file_put_contents('.env', $env);
echo "✓ Application key generated\n";

// Create database
if (!file_exists('database/database.sqlite')) {
    echo "\n💾 Creating SQLite database...\n";
    touch('database/database.sqlite');
    echo "✓ Database file created\n";
}

// Run migrations
echo "\n📊 Running database migrations...\n";
exec('php artisan migrate:fresh', $output, $return);
if ($return !== 0) {
    echo "⚠️  Migrations might have failed. Check manually.\n";
} else {
    echo "✓ Migrations completed\n";
}

// Run seeders
echo "\n🌱 Seeding database...\n";
exec('php artisan db:seed', $output, $return);
if ($return !== 0) {
    echo "⚠️  Seeding might have failed. Check manually.\n";
} else {
    echo "✓ Database seeded\n";
}

// Create storage links
echo "\n🔗 Creating storage symlink...\n";
if (!file_exists('public/storage')) {
    @symlink('../storage/app/public', 'public/storage');
    echo "✓ Storage symlink created\n";
}

// Set permissions
echo "\n🔐 Setting permissions...\n";
@chmod('storage', 0775);
@chmod('bootstrap/cache', 0775);
echo "✓ Permissions set\n";

echo "\n╔════════════════════════════════════════════════════════════════╗\n";
echo "║                 Installation Complete! ✓                      ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

echo "📍 Admin Panel: http://localhost:8000/admin\n";
echo "👤 Default Credentials:\n";
echo "   Email: admin@example.com\n";
echo "   Password: admin123\n\n";
echo "🚀 To start the development server:\n";
echo "   php artisan serve\n\n";
echo "⚠️  IMPORTANT: Change the default admin password after first login!\n\n";
