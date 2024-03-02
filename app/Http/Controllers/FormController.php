<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Registered;

class FormController extends Controller
{
    public function show($token)
    {
        // Trouve le token dans la table "registered"
        $registeredToken = Registered::where('token', $token)->where('is_used', false)->first();

        // Vérifie si le token existe et n'a pas expiré
        if ($registeredToken) {
            // Marque le token comme utilisé
            $registeredToken->update(['is_used' => true]);

            // Récupère la question spécifique avec son type et ses réponses associées
            $question = Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->findOrFail($registeredToken->course_id);

            // Renvoie la vue Inertia 'Formulaire' avec les données nécessaires
            return Inertia::render('Formulaire', [
                'question' => $question,
                'questions' => Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->get(),
                'answers' => Answer::all(),
                'registeredToken' => $registeredToken, // Passe le token à la vue si nécessaire
            ]);
        } else {
            // Redirige ou affiche un message d'erreur si le token est invalide, expiré, ou déjà utilisé
            return redirect()->route('accueil')->with('error', 'Token invalide, expiré, ou déjà utilisé.');
        }
    }

    public function store(Request $request, $token)
    {
        // Trouve le token dans la table "registered"
        $registeredToken = Registered::where('token', $token)->where('is_used', false)->first();

        // Vérifie si le token existe et n'a pas expiré
        if ($registeredToken) {
            // Marque le token comme utilisé
            $registeredToken->update(['is_used' => true]);

            // Récupère le registered_id
            $registeredId = $registeredToken->id;

            // Boucle sur les questions et enregistre les réponses dans la base de données
            foreach ($request->responses as $questionId => $response) {
                // Crée une nouvelle réponse dans la base de données
                FormResponse::create([
                    'registered_id' => $registeredId,
                    'question_id' => $questionId,
                    'response' => $response,
                    'comment' => $request->comments[$questionId] ?? null,
                ]);
            }

            // Réponse de succès (tu peux ajuster cela en fonction de tes besoins)
        } else {
            // Redirige ou affiche un message d'erreur si le token est invalide, expiré, ou déjà utilisé
        }
    }
}
