<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/download-cv', [PortfolioController::class, 'downloadCV'])->name('download.cv');

// Admin auth (guest only)
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Protected admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('skills', SkillController::class)->except('show');
    Route::resource('testimonials', TestimonialController::class)->except('show');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/read', [ContactMessageController::class, 'markRead'])->name('messages.read');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
});
