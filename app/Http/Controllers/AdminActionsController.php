<?php

// app/Http/Controllers/AdminActionsController.php


namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registered;
use App\Models\Teacher;

class AdminActionsController extends Controller
{
    public function index()
    {
        return inertia('AdminActions');
    }

    public function linkIndex()
    {
        // Récupère tous les cours finis il y a deux semaines minimum
        $twoWeeksAgo = now()->subWeeks(2);
        $finishedCourses = Course::where('end_time', '<', $twoWeeksAgo)->get();

        // Récupère tous les liens créés pour chaque cours
        $linksByCourse = [];
        foreach ($finishedCourses as $course) {
            $linksByCourse[$course->name] = Registered::where('course_id', $course->id)->pluck('token');
        }

        // Récupère tous les professeurs
        $teachers = Teacher::all();

        return inertia('LinkIndex', [
            'finishedCourses' => $finishedCourses,
            'linksByCourse' => $linksByCourse,
            'teachers' => $teachers,
        ]);
    }
}
