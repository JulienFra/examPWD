<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AdminActionsController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('admin.actions');
})->name('home');

Route::get('/admin-actions', [AdminActionsController::class, 'index'])
    ->name('admin.actions');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
