<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! uwu
|
*/
use App\Http\Controllers\AdminActionsController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('admin.actions');
})->middleware(['auth'])->name('home');

Route::get('/admin-actions', [AdminActionsController::class, 'index'])
    ->middleware(['auth'])
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
