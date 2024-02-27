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
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('admin.actions.index');
})->middleware(['auth'])->name('home');

Route::get('/admin-actions', [AdminActionsController::class, 'index'])->name('admin.actions.index');

// Routes pour les étudiants
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/edit-course', [StudentController::class, 'editCourse'])->name('students.edit-course');
Route::put('/students/{id}/update-course', [StudentController::class, 'updateCourse'])->name('students.update-course');
Route::put('/students/{id}/update-section', [StudentController::class, 'updateSection'])->name('students.updateSection');
Route::get('/students/{id}/edit-section', [StudentController::class, 'editSection'])->name('students.edit-section');

// Routes pour les sections
Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
Route::post('/sections/store', [SectionController::class, 'store'])->name('sections.store');
Route::get('/sections/{id}', [SectionController::class, 'show'])->name('sections.show');
Route::delete('/sections/{id}', [SectionController::class, 'destroy'])->name('sections.destroy');

// Ajoute d'autres routes pour les sections au besoin

Route::get('/sections/{id}/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/sections/{id}/courses', [CourseController::class, 'store'])->name('courses.store');
Route::post('/sections/{sectionId}/courses', [CourseController::class, 'store'])->name('courses.store');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
Route::put('/courses/{courseId}', [CourseController::class, 'update'])->name('courses.update');
Route::get('/courses/{courseId}/edit', [CourseController::class, 'edit'])->name('courses.edit');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
