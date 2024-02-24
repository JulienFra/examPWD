<?php

namespace App\Http\Controllers;

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
        $student = Student::with('sections.sectionCourses.course')->findOrFail($id);

        return Inertia::render('Students/Show', [
            'student' => $student,
        ]);
    }
}
