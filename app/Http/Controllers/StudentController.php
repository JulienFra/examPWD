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
        $student = Student::with('sections.courses')->findOrFail($id);
        $sections = Section::all();

        return Inertia::render('Students/Edit', [
            'student' => $student,
            'sections' => $sections,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            // Ajoutez d'autres règles de validation au besoin
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.show', $student->id);
    }

    public function editSection($id)
    {
        $student = Student::with('sections.courses')->findOrFail($id);
        $sections = Section::all();

        return Inertia::render('Students/EditSection', [
            'student' => $student,
            'sections' => $sections,
        ]);
    }

    public function updateSection(Request $request, $studentId)
    {
        $selectedSections = $request->input('selectedSections', []);

        $student = Student::findOrFail($studentId);

        $student->sections()->sync($selectedSections);

        $removedCourses = Course::whereDoesntHave('sections', function ($query) use ($selectedSections) {
            $query->whereIn('section_id', $selectedSections);
        })->get();

        $student->courses()->detach($removedCourses);

        return redirect()->route('students.show', $student->id);
    }


    public function editCourse($id)
    {
        $student = Student::find($id);

        // Obtenez les cours liés à l'étudiant
        $studentCourses = $student->courses;

        // Obtenez les IDs des cours auxquels l'étudiant est inscrit
        $selectedCourseIds = $studentCourses->pluck('id')->toArray();

        // Obtenez tous les cours des sections de l'élève
        // Obtenez les IDs des sections auxquelles l'étudiant est inscrit
        $sectionIds = $student->sections->pluck('id');

        // Obtenez les cours liés aux sections auxquelles l'étudiant est inscrit
        $sectionCourses = Course::whereHas('sections', function ($query) use ($sectionIds) {
            $query->whereIn('sections.id', $sectionIds);
        })->get();
        // Fusionnez les cours spécifiques à l'élève avec les cours des sections
        $courses = $studentCourses->merge($sectionCourses);

        return inertia('Students/EditCourse', [
            'student' => $student,
            'courses' => $courses,
            'selectedCourseIds' => $selectedCourseIds,
        ]);
    }



    public function updateCourse(Request $request, $studentId)
    {
        $request->validate([
            'selectedCourses' => 'required|array',
            'selectedCourses.*' => 'exists:courses,id',
        ]);

        $student = Student::findOrFail($studentId);
        $student->courses()->sync($request->selectedCourses);

        return redirect()->route('students.show', $student->id);
    }
}
