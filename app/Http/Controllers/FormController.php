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

        return Inertia::render('Formulaire', [
            'form' => $form,
            'questions' => $questions,
        ]);
    }
}
