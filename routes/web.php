<?php

use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\NoteController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\PermissionController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\Public\PublicNoteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/cms/dashboard');

Route::name('cms.')
    ->prefix('cms')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        Route::get('notes/users', [NoteController::class, 'getUserList'])->name('notes.users');
        Route::resource('notes', NoteController::class);

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile/edit', 'edit')->name('profile.edit');
            Route::get('/profile', 'show')->name('profile.show');
            Route::patch('/profile', 'update')->name('profile.update');
        });
    });

Route::get('/p/notes/{publicId}', [PublicNoteController::class, 'show'])->name('public.notes.show');

require __DIR__ . '/auth.php';
