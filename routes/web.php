<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\LiveChatAgentReplyController;


// Public routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/download-cv', [PortfolioController::class, 'downloadCV'])->name('download.cv');
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');
Route::get('/api/projects/search', [CaseStudyController::class, 'search']);
Route::get('/playground', [PortfolioController::class, 'playground'])->name('playground');

// Live Chat (public, no auth)
Route::prefix('live-chat')->middleware('throttle:30,1')->group(function () {

    Route::get('/fetch', [LiveChatController::class, 'fetch']);
    Route::get('/status', [LiveChatController::class, 'status']);
    Route::post('/typing', [LiveChatController::class, 'typing']);
});

// Admin auth (guest only)
Route::prefix('admin/live-chat')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/reply', [LiveChatAgentReplyController::class, 'reply'])->name('admin.live-chat.reply');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1');

// Protected admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
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
