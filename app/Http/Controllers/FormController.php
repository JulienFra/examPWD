<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class FormController extends Controller
{
    public function showEvaluationForm()
    {
        $questions = Question::all(); // Récupérer toutes les questions depuis la base de données

        return view('evaluation-form', ['questions' => $questions]);
    }
}
