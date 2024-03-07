<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class FormController extends Controller
{
    protected $openaiService;

    public function __construct(OpenAIService $openaiService)
    {
        $this->openaiService = $openaiService;
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
