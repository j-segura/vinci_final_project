<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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

Route::get('/subscription-plans', [PlanController::class, 'show'])->middleware(['auth', 'verified'])->name('subscription.plans');

Route::get('/admin', function () {
    return Inertia::render('Admin');
})->middleware(['auth', 'verified'])->name('admin');


/* Tags */
Route::resource('admin/tags', TagsController::class)->middleware(['auth', 'verified']);
/* Categories */
Route::resource('admin/categories', CategoryController::class)->middleware(['auth', 'verified']);
/* Subscription plan */
Route::resource('admin/plans', PlanController::class)->middleware(['auth', 'verified']);
/* Projects */
Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::put('/project/{project}', [ProjectController::class, 'update'])->name('project.update');
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/profile/manager', [ProfileController::class, 'manager'])->name('profile.manager');
Route::get('/profile/show', [ProfileController::class, 'manager'])->name('profile.show');

Route::post('/project/comment/{project}', [CommentController::class, 'store'])->name('comments.store');


require __DIR__.'/auth.php';
