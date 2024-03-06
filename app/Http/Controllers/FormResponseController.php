<?php

namespace App\Http\Controllers;

use App\Models\FormResponse;
use App\Models\Question;
use App\Models\Teacher;
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
        // Récupérer les réponses et les commentaires envoyés depuis le frontend
        $response = $request->input('response'); // Changement ici
        $comment = $request->input('comment'); // Changement ici
        
        // Enregistrer chaque réponse dans la table FormResponse
        foreach ($response as $questionId => $responseData) {
            // Vérifie si la réponse existe pour cette question
            if (isset($responseData)) {
                // Créez un nouveau modèle FormResponse
                $formResponse = new FormResponse();
                $formResponse->question_id = $questionId;
                $formResponse->response = $responseData;
                $formResponse->comment = $comment[$questionId] ?? null; // Le commentaire peut être facultatif
                $formResponse->save();
            }
        }

        // Répondre avec succès en renvoyant une réponse JSON
        return response()->json(['message' => 'Formulaire soumis avec succès.']);
    }

    

}


