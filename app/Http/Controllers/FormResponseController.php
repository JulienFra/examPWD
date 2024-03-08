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
        $responses = FormResponse::whereHas('student_course', function ($query) use ($courseId) {
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

    // Enregistre chaque réponse dans la base de données
    foreach ($requestData['question_ids'] as $questionId) {
        // Vérifie si la réponse est un tableau (cas des checkbox)
        if (is_array($requestData['response'][$questionId])) {
            // Enregistre chaque réponse de type checkbox dans une ligne différente
            foreach ($requestData['response'][$questionId] as $response) {
                $formResponse = new FormResponse();
                $formResponse->student_course_id = $requestData['student_course_id'];
                $formResponse->question_id = $questionId;
                $formResponse->response = $response;
                $formResponse->comment = $requestData['comment'][$questionId] ?? null;
                $formResponse->save();
            }
        } else {
            // Pour les autres types de réponses, enregistre simplement la réponse
            $formResponse = new FormResponse();
            $formResponse->student_course_id = $requestData['student_course_id'];
            $formResponse->question_id = $questionId;
            $formResponse->response = $requestData['response'][$questionId] ?? null;
            $formResponse->comment = $requestData['comment'][$questionId] ?? null;
            $formResponse->save();
        }
    }

    // Redirige avec un message de succès
    return redirect()->route('home')->with('success', 'Réponses enregistrées avec succès.');
}






}


