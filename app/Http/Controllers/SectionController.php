<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::latest()->get();

        return Inertia::render('SectionsIndex', [
            'sections' => $sections,
        ]);
    }

    public function show($id)
    {
        $section = Section::with('courses.teacher')->findOrFail($id);

        return Inertia::render('Sections/Show', [
            'section' => $section,
        ]);
    }

    public function destroy($id)
    {
        $section = Section::with('courses')->findOrFail($id);

        // Vérifie si la section a des cours avant de tenter de les supprimer
        if ($section->courses) {
            // Supprime les cours liés
            foreach ($section->courses as $course) {
                $course->delete();
            }
        }

        // Supprime la section
        $section->delete();

        return redirect()->route('sections.index');
    }

    public function create()
    {
        return Inertia::render('Sections/Create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire, ajuste selon tes besoins
        $request->validate([
            'name' => 'required|string|max:255',
            // Ajoute d'autres règles de validation si nécessaire
        ]);

        // Crée une nouvelle section
        Section::create($request->all());

        return redirect()->route('sections.index');
    }
}
