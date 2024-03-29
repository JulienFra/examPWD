<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\StudentCourse;

class FormController extends Controller
{
    public function show($token)
    {
        // Trouve le token dans la table "student_courses"
        $studentCourse = StudentCourse::where('token', $token)->where('is_used', false)->first();
        // Vérifie si le token existe et n'a pas expiré
        if ($studentCourse) {
            // Marque le token comme utilisé

            // Récupère la question spécifique avec son type et ses réponses associées
            $question = Question::with(['type', 'answers'])
                ->where('is_deleted', false);


            // Renvoie la vue Inertia 'Formulaire' avec les données nécessaires
            return Inertia::render('Formulaire', [
                'question' => $question,
                'questions' => Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->get(),
                'answers' => Answer::all(),
                'studentCourse' => $studentCourse, // Passe le token à la vue si nécessaire
            ]);
        } else {
            // Redirige ou affiche un message d'erreur si le token est invalide, expiré, ou déjà utilisé
            return redirect()->route('home')->with('error', 'Token invalide, expiré, ou déjà utilisé.');
        }
    }
}
