<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// ─── Home ──────────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('properties.search');


// ─── Legacy dashboard route (redirect to role-specific) ───────────────────────
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'landlord' => redirect()->route('landlord.dashboard'),
        default    => redirect()->route('student.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── Profile Routes (Breeze default) ──────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])
            ->name('dashboard');

        // Property management
        Route::get('/properties',                    [\App\Http\Controllers\Admin\AdminController::class, 'properties'])->name('properties');
        Route::get('/properties/{property}',         [\App\Http\Controllers\Admin\AdminController::class, 'propertyDetail'])->name('properties.detail');
        Route::post('/properties/{property}/approve',[\App\Http\Controllers\Admin\AdminController::class, 'approveProperty'])->name('properties.approve');
        Route::post('/properties/{property}/reject', [\App\Http\Controllers\Admin\AdminController::class, 'rejectProperty'])->name('properties.reject');

        // Landlord verification
        Route::get('/landlords',                   [\App\Http\Controllers\Admin\AdminController::class, 'landlords'])->name('landlords');
        Route::post('/landlords/{landlord}/verify',[\App\Http\Controllers\Admin\AdminController::class, 'verifyLandlord'])->name('landlords.verify');
        Route::post('/landlords/{landlord}/reject',[\App\Http\Controllers\Admin\AdminController::class, 'rejectLandlord'])->name('landlords.reject');

        // Users
        Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    });


// ─── Student Routes ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'student'])->name('dashboard');
    });

// ─── Landlord Routes ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:landlord'])
    ->prefix('landlord')
    ->name('landlord.')
    ->group(function () {
        // Dashboard (index) — handled by PropertyController
        Route::get('/dashboard', [\App\Http\Controllers\Landlord\PropertyController::class, 'index'])
            ->name('dashboard');

        // Property management
        Route::get('/properties/create',       [\App\Http\Controllers\Landlord\PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties',             [\App\Http\Controllers\Landlord\PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}',   [\App\Http\Controllers\Landlord\PropertyController::class, 'show'])->name('properties.show');
        Route::delete('/properties/{property}',[\App\Http\Controllers\Landlord\PropertyController::class, 'destroy'])->name('properties.destroy');
    });

require __DIR__.'/auth.php';
