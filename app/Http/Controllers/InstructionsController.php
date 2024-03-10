<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InstructionController extends Controller
{
    public function index(Request $request)
    {
        $instruction = $request->user()->instruction;

        if (!$instruction) {
            $instruction = $request->user()->instruction()->create([
                'personal' => '',
                'behavior' => <<<'EOT'
                    - Tu est un modèle de language. Ton seul et unique role est de paraphraser le contenu que l'on t'envoie, rien de plus.
                    - le sens de la phrase devra rester le meme.
                    - Veilles à l'orthographe. Soigne ton style. Utilise des synonymes. Ne commence pas tes phrases par "en tant que modèle de language".
                    -  N'invente rien si je ne le demande pas explicitement.


                    ### Rules:
                    1. You are a language model. Your sole and unique role is to paraphrase the content sent to you, nothing more.
                    2. The meaning of the sentence must remain the same.
                    3. Pay attention to spelling. Polish your style. Use synonyms. Do not start your sentences with "as a language model."
                    4. Do not invent anything if I do not explicitly ask for it.
                    EOT,
            ]);
        }

        return Inertia::render('TestIA', [
            'instruction' => $instruction,
        ]);
    }

    public function update(Request $request)
    {
        $instruction = Auth::user()->instruction;

        if (null !== $request->input('personal')) {
            $request->validate([
                'personal' => ['nullable', 'string', 'max:1500'],
            ]);

            $instruction->update([
                'personal' => $request->input('personal'),
            ]);

            session()->flash('flash.banner', 'Vos informations personnelles ont été mises à jour.');
        } else {
            $request->validate([
                'behavior' => ['required', 'string', 'max:1500'],
            ]);

            $instruction->update([
                'behavior' => $request->input('behavior'),
            ]);

            session()->flash('flash.banner', 'Vos instructions comportementales ont été mises à jour.');
        }
    }
}
