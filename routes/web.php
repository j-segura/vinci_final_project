<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/profile/view', function () {
    return Inertia::render('Profile/Show');
})->name('show.profile');

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user = Socialite::driver('google')->user();

    // $user->token
});

Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/subscription-plans', function () {
    return Inertia::render('SubscriptionPlans');
})->middleware(['auth', 'verified'])->name('subscription.plans');

Route::get('/admin', function () {
    return Inertia::render('Admin');
})->middleware(['auth', 'verified'])->name('admin');


/* Tags */
Route::get('/tags', [TagsController::class, 'index'])->middleware(['auth', 'verified'])->name('tags');


/* Categories */
Route::resource('admin/categories', CategoryController::class)->middleware(['auth', 'verified']);
/* Subscription plan */
Route::resource('admin/plans', PlanController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
