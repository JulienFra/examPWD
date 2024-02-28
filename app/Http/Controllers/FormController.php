<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Inertia\Inertia;
use App\Models\Question;

class FormController extends Controller
{
    public function show($id)
{
    $form = Form::findOrFail($id);
    $questions = $form->questions;

    // Récupérer les réponses pour chaque question
    $answers = [];
    foreach ($questions as $question) {
        $answers[$question->id] = $question->answers;
    }

    return Inertia::render('Formulaire', [
        'form' => $form,
        'questions' => $questions,
        'answers' => $answers,
    ]);
}

}
