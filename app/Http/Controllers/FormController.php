<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use GuzzleHttp\Client;
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
            $studentCourse->update(['is_used' => true]);

            // Récupère la question spécifique avec son type et ses réponses associées
            $question = Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->findOrFail($studentCourse->course_id);

        return Inertia::render('Formulaire', [
            'question' => $question,
            'questions' => Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->get(), // Pass all questions excluding deleted ones
            'answers' => Answer::all(),
        ]);
    }

    public function processForm(Request $request)
    {
        // Récupérer les données du formulaire
        $formData = $request->all();

        // Appeler l'API OpenAI pour obtenir une réponse
        $response = $this->callOpenAI($formData['prompt']);

        // Récupérer la réponse de l'API OpenAI
        $generatedText = $response['choices'][0]['text'];

        // Retourner la réponse à votre vue
        return view('form', ['generatedText' => $generatedText]);
    }

    private function callOpenAI($prompt)
    {
        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'), // Utilisez votre clé API OpenAI
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'text-davinci-002', // Modèle d'IA à utiliser
                'prompt' => $prompt, // Texte d'entrée à envoyer à l'IA
                'max_tokens' => 50, // Nombre maximum de jetons dans la réponse
            ],
        ]);

        return json_decode($response->getBody(), true);

    }
}

