<?php

// app/Http/Controllers/TeacherController.php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return Inertia::render('TeachersIndex', [
            'teachers' => $teachers,
        ]);
    }

    public function create()
    {
        return Inertia::render('Teachers/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Teacher::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('teachers.index');
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return Inertia::render('Teachers/Show', [
            'teacher' => $teacher,
        ]);
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        return inertia('Teachers/Edit', [
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('teachers.index');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index');
    }
}
