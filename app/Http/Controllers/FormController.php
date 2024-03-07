<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\StudentCourse;
use App\Services\OpenAIService;

class FormController extends Controller
{
    protected $openaiService;

    public function __construct(OpenAIService $openaiService)
    {
        $this->openaiService = $openaiService;
    }

    public function show($token)
    {
        // Trouve le token dans la table "student_courses"
        $studentCourse = StudentCourse::where('token', $token)->where('is_used', false)->first();

        // Vérifie si le token existe et n'a pas expiré
        if ($studentCourse) {
            // Marque le token comme utilisé
            $studentCourse->update(['is_used' => true]);

            // Récupère la question spécifique avec son type et ses réponses associées
            $question = Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->findOrFail($studentCourse->course_id);

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

    public function store(Request $request)
    {
        // Valider et enregistrer les données du formulaire

        // Paraphraser la réponse ouverte de l'élève
        $paraphrasedResponse = $this->openaiService->paraphrase($request->input('open_response'));

        // Enregistrer la réponse paraphrasée dans la base de données

        // Rediriger ou afficher un message de confirmation
    }
}
