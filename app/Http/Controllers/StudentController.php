<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\Student;
use App\Models\SectionCourse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return Inertia::render('StudentsIndex', [
            'students' => $students,
        ]);
    }

    public function show($id)
    {
        $student = Student::with(['courses', 'sections'])->findOrFail($id);

        return Inertia::render('Students/Show', [
            'student' => $student,
        ]);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return Inertia::render('Students/Edit', [
            'student' => $student,
        ]);
    }
}
