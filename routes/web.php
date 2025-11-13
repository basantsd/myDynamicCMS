<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomBlockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth'])->group(function () {

        // Dashboard - No permission required (all authenticated users can access)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Pages Management - Permission Protected
        Route::middleware(['permission:pages.view'])->group(function () {
            Route::get('/pages', [PageController::class, 'index'])->name('admin.pages.index');
        });
        Route::middleware(['permission:pages.create'])->group(function () {
            Route::get('/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
            Route::post('/pages', [PageController::class, 'store'])->name('admin.pages.store');
        });
        Route::middleware(['permission:pages.edit'])->group(function () {
            Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
            Route::put('/pages/{id}', [PageController::class, 'update'])->name('admin.pages.update');
            Route::get('/pages/{id}/builder', [PageController::class, 'builder'])->name('admin.pages.builder');
            Route::post('/pages/{id}/builder/save', [PageController::class, 'builderSave'])->name('admin.pages.builder.save');
            // Page Sections
            Route::post('/page-sections', [PageSectionController::class, 'store'])->name('admin.sections.store');
            Route::put('/page-sections/{id}', [PageSectionController::class, 'update'])->name('admin.sections.update');
            Route::post('/page-sections/reorder', [PageSectionController::class, 'updateOrder'])->name('admin.sections.reorder');
            // Table Management for Page Sections
            Route::post('/page-sections/{id}/import-csv', [PageSectionController::class, 'importCsv'])->name('admin.sections.import-csv');
            Route::post('/page-sections/{id}/table/add-column', [PageSectionController::class, 'addTableColumn'])->name('admin.sections.table.add-column');
            Route::delete('/page-sections/{id}/table/remove-column', [PageSectionController::class, 'removeTableColumn'])->name('admin.sections.table.remove-column');
            Route::put('/page-sections/{id}/table/update-cell', [PageSectionController::class, 'updateTableCell'])->name('admin.sections.table.update-cell');
            Route::get('/page-sections/{id}/table/export-csv', [PageSectionController::class, 'exportTableCsv'])->name('admin.sections.table.export-csv');
        });
        Route::middleware(['permission:pages.delete'])->group(function () {
            Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
            Route::delete('/page-sections/{id}', [PageSectionController::class, 'destroy'])->name('admin.sections.destroy');
        });

        // Form Submissions Management - Permission Protected
        Route::middleware(['permission:forms.view'])->group(function () {
            Route::get('/form-submissions', [FormSubmissionController::class, 'index'])->name('admin.form-submissions.index');
            Route::get('/form-submissions/form/{formName}', [FormSubmissionController::class, 'getByForm'])->name('admin.form-submissions.by-form');
            Route::get('/form-submissions/statistics', [FormSubmissionController::class, 'statistics'])->name('admin.form-submissions.statistics');
            Route::get('/form-submissions/{id}', [FormSubmissionController::class, 'show'])->name('admin.form-submissions.show');
        });
        Route::middleware(['permission:forms.export'])->group(function () {
            Route::get('/form-submissions/export/{formName}', [FormSubmissionController::class, 'export'])->name('admin.form-submissions.export');
        });
        Route::middleware(['permission:forms.delete'])->group(function () {
            Route::delete('/form-submissions/{id}', [FormSubmissionController::class, 'destroy'])->name('admin.form-submissions.destroy');
        });

        // Custom Blocks Management - Permission Protected
        Route::middleware(['permission:blocks.view'])->group(function () {
            Route::get('/custom-blocks', [CustomBlockController::class, 'index'])->name('admin.blocks.index');
            Route::get('/custom-blocks/list', [CustomBlockController::class, 'list'])->name('admin.blocks.list');
            Route::get('/custom-blocks/{id}', [CustomBlockController::class, 'show'])->name('admin.blocks.show');
        });
        Route::middleware(['permission:blocks.create'])->group(function () {
            Route::get('/custom-blocks/create', [CustomBlockController::class, 'create'])->name('admin.blocks.create');
            Route::post('/custom-blocks', [CustomBlockController::class, 'store'])->name('admin.blocks.store');
            Route::post('/custom-blocks/{id}/duplicate', [CustomBlockController::class, 'duplicate'])->name('admin.blocks.duplicate');
        });
        Route::middleware(['permission:blocks.edit'])->group(function () {
            Route::get('/custom-blocks/{id}/edit', [CustomBlockController::class, 'edit'])->name('admin.blocks.edit');
            Route::put('/custom-blocks/{id}', [CustomBlockController::class, 'update'])->name('admin.blocks.update');
            Route::post('/custom-blocks/{id}/toggle', [CustomBlockController::class, 'toggleActive'])->name('admin.blocks.toggle');
        });
        Route::middleware(['permission:blocks.delete'])->group(function () {
            Route::delete('/custom-blocks/{id}', [CustomBlockController::class, 'destroy'])->name('admin.blocks.destroy');
        });

        // Menus Management - Permission Protected
        Route::middleware(['permission:menus.view'])->group(function () {
            Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');
        });
        Route::middleware(['permission:menus.manage'])->group(function () {
            Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
            Route::post('/menu-items', [MenuController::class, 'storeItem'])->name('admin.menu-items.store');
            Route::put('/menu-items/{id}', [MenuController::class, 'updateItem'])->name('admin.menu-items.update');
            Route::post('/menu-items/reorder', [MenuController::class, 'updateOrder'])->name('admin.menu-items.reorder');
            Route::delete('/menu-items/{id}', [MenuController::class, 'destroyItem'])->name('admin.menu-items.destroy');
        });

        // Media Library - Permission Protected
        Route::middleware(['permission:media.view'])->group(function () {
            Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
            Route::get('/media/list', [MediaController::class, 'list'])->name('admin.media.list');
        });
        Route::middleware(['permission:media.upload'])->group(function () {
            Route::post('/media/upload', [MediaController::class, 'upload'])->name('admin.media.upload');
            Route::put('/media/{id}', [MediaController::class, 'update'])->name('admin.media.update');
        });
        Route::middleware(['permission:media.delete'])->group(function () {
            Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');
        });

        // Settings - Permission Protected
        Route::middleware(['permission:settings.view'])->group(function () {
            Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        });
        Route::middleware(['permission:settings.edit'])->group(function () {
            Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
        });

        // Users Management - Admin Only
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

            // Roles & Permissions Management - Admin Only
            Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
            Route::get('/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
            Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
            Route::put('/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
            Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Routes (MUST BE LAST - catch-all)
|--------------------------------------------------------------------------
*/

// Public Form Submission
Route::post('/api/form-submit', [FormSubmissionController::class, 'submit'])->name('form.submit');

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/{slug}', [FrontendController::class, 'showPage'])->name('page.show');
