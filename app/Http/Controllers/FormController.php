<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;

class FormController extends Controller
{
    public function show($id)
    {
        $question = Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->findOrFail($id);

        return Inertia::render('Formulaire', [
            'question' => $question,
            'questions' => Question::with(['type', 'answers'])->where('is_deleted', '!=', 1)->get(), // Pass all questions excluding deleted ones
            'answers' => Answer::all(), // Pass all answers
        ]);
    }
}
