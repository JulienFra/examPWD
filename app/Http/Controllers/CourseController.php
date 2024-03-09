<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function create($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $teachers = Teacher::all(); // Récupère tous les enseignants


        return Inertia::render('Courses/Create', [
            'section' => $section,
            'teachers' => $teachers,
        ]);
    }

    public function store(Request $request, $sectionId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'end_time' => 'required|date',
            'teacher_id' => 'exists:teachers,id',
            // Ajoute d'autres règles de validation si nécessaire
        ]);

        $section = Section::findOrFail($sectionId);

        // Crée un nouveau cours associé à la section
        $course = new Course([
            'name' => $request->input('name'),
            'end_time' => $request->input('end_time'),
            'teacher_id' => $request->input('teacher_id'),
        ]);

        $section->courses()->save($course);

        return redirect()->route('sections.show', ['id' => $sectionId]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        // Retourne une réponse (peut être personnalisé selon les besoins)
        return redirect()->back();
    }

    public function edit($courseId)
    {
        $course = Course::findOrFail($courseId);
        $teachers = Teacher::all(); // Charger tous les enseignants

        return Inertia::render('Courses/Edit', [
            'course' => $course,
            'teachers' => $teachers,
        ]);
    }


    public function update(Request $request, $courseId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'end_time' => 'required|date',
            'teacher_id' => 'exists:teachers,id',
        ]);

        $course = Course::findOrFail($courseId);

        // Mettez à jour les champs du cours
        $course->update([
            'name' => $request->input('name'),
            'end_time' => $request->input('end_time'),
            'teacher_id' => $request->input('teacher_id'),
        ]);
    }
}
