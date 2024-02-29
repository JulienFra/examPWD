<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;

class FormController extends Controller
{
    public function show($id)
    {
        // Fetch all questions
        $questions = Question::all();

        // Récupérer les réponses pour chaque question
        $answers = [];
        foreach ($questions as $question) {
            $answers[$question->id] = explode("#", $question->choix);
        }

        return Inertia::render('Formulaire', [
            'form' => null, // You can remove this if not needed in the component
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
}
