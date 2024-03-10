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
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormResponseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TeacherController;
use App\Mail\MyEmail;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return redirect()->route('admin.actions.index');
})->name('home');



        Route::get('/admin-actions', [AdminActionsController::class, 'index'])->name('admin.actions.index');
        Route::get('/admin-actions/link-index', [AdminActionsController::class, 'linkIndex'])->name('admin-actions.linkIndex');

        // Routes pour les étudiants
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

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
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
        Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}/update', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}/destroy', [TeacherController::class, 'destroy'])->name('teachers.destroy');


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

        Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
        Route::delete('questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

        Route::get('questions/{id}/edit-contenu', [QuestionController::class, 'editContenu'])->name('questions.editContenu');
        Route::put('questions/{id}/update-contenu', [QuestionController::class, 'updateContenu'])->name('questions.updateContenu');

        Route::get('questions/{id}/edit-type', [QuestionController::class, 'editType'])->name('questions.editType');
        Route::put('questions/{id}/update-type', [QuestionController::class, 'updateType'])->name('questions.updateType');

        Route::get('questions/{id}/edit-reponses', [QuestionController::class, 'editReponses'])->name('questions.editReponses');
        Route::put('questions/{id}/update-reponses', [QuestionController::class, 'updateReponses'])->name('questions.updateReponses');

        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

        Route::get('/formulaire/{token}', [FormController::class, 'show'])->name('formulaire.show');
        Route::post('/formulaire/store', [FormResponseController::class, 'store'])->name('formulaire.store');
        Route::get('/form-responses/{teacherToken}', [FormResponseController::class, 'index']);
        Route::get('/form-responses/{teacherToken}/courses/{courseId}', [FormResponseController::class, 'showResponses'])
            ->name('course.responses');

        Route::get('/send-email/{courseId}', [EmailController::class, 'sendEmails'])->name('send.email');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
