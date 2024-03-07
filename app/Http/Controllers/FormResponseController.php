<?php

namespace App\Http\Controllers;

use App\Models\FormResponse;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Form;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StudentCourse;

class FormResponseController extends Controller
{

    public function index($teacherToken)
    {
        $teacher = Teacher::where('token', $teacherToken)->firstOrFail();
        $courses = $teacher->courses;

        return Inertia::render('FormResponseIndex', [
            'teacher' => $teacher,
            'courses' => $courses,
        ]);
    }
    public function showResponses($teacherToken, $courseId)
    {
        // Récupère les données nécessaires pour afficher les réponses du cours
        $teacher = Teacher::where('token', $teacherToken)->firstOrFail();
        $course = $teacher->courses()->findOrFail($courseId);

        // Récupère les réponses associées au cours en utilisant la relation indirecte
        $responses = FormResponse::whereHas('registered', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();

        // Récupère les questions associées aux réponses du cours
        $questions = Question::whereIn('id', $responses->pluck('question_id'))->get();

        return Inertia::render('FormResponse/CourseResponses', [
            'teacher' => $teacher,
            'course' => $course,
            'questions' => $questions,
            'responses' => $responses,
        ]);
    }

    
    public function store(Request $request)
{
    // Récupération des données de la requête
    $requestData = $request->all();
    
    // Crée une nouvelle réponse de formulaire
    $formResponse = FormResponse::create([
        'student_course_id' => $requestData['student_course_id'],
    ]);

    // Enregistre chaque réponse dans la base de données
    foreach ($requestData['responses'] as $questionId => $responses) {
        if (is_array($responses)) {
            foreach ($responses as $response) {
                // Stocke l'ID de la question dans la variable $formResponse
                $formResponse->answers()->create([
                    'question_id' => $questionId,
                    'response' => $response,
                    'comment' => $requestData['comments'][$questionId] ?? null,
                ]);
            }
        } else {
            // Stocke l'ID de la question dans la variable $formResponse
            $formResponse->answers()->create([
                'question_id' => $questionId,
                'response' => $responses,
                'comment' => $requestData['comments'][$questionId] ?? null,
            ]);
        }
    }

    // Redirige avec un message de succès
    return redirect()->route('home')->with('success', 'Réponses enregistrées avec succès.');
}


}

