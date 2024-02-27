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
    // Recherche du formulaire par son ID
    $form = Form::findOrFail($id);

    // Récupération des questions associées au formulaire
    $questions = $form->questions;

    // Retourne la vue Inertia avec les questions du formulaire
    return Inertia::render('Formulaire', [
        'form' => $form,
        'questions' => $questions,
    ]);
}

}