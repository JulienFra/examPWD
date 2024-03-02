<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Type;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with(['type', 'answers'])
            ->where('is_deleted', false)
            ->get();

        return Inertia::render('QuestionsIndex', [
            'questions' => $questions,
        ]);
    }
    public function store(Request $request)
    {
        // Validez les données du formulaire ici si nécessaire

        $newQuestion = Question::create([
            'content' => $request->input('content'),
            'type_id' => 1, // Ajoutez la logique nécessaire pour le type de la question
        ]);

        return redirect()->route('questions.show', ['id' => $newQuestion->id])->with('success', 'Question ajoutée avec succès!');
    }

    public function show($id)
    {
        $question = Question::with(['type', 'answers'])
            ->where('is_deleted', false)
            ->findOrFail($id);

        return Inertia::render('Questions/Show', [
            'question' => $question,
        ]);
    }

    public function editContenu($id)
    {
        $question = Question::with(['type', 'answers'])->findOrFail($id);

        return Inertia::render('Questions/EditContenu', [
            'question' => $question,
        ]);
    }

    public function updateContenu(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'content' => 'required',
            'have_a_comment' => 'boolean', // Assurez-vous que le champ est booléen
        ]);

        $question->update([
            'content' => $request->input('content'),
            'have_a_comment' => $request->input('have_a_comment', false),
        ]);

        return redirect()->route('questions.show', ['id' => $question->id])->with('success', 'Contenu de la question mis à jour avec succès!');
    }

    // ...

    public function editType($id)
    {
        $question = Question::with(['type', 'answers'])->findOrFail($id);
        $types = Type::all();

        return Inertia::render('Questions/EditType', [
            'question' => $question,
            'types' => $types,
        ]);
    }

    public function updateType(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // Validez les données du formulaire ici si nécessaire

        $newTypeId = $request->input('type_id');

        // Si le type a changé, supprimez les anciennes réponses liées à la question
        if ($newTypeId != $question->type_id) {
            $question->answers()->delete();
        }

        $question->update([
            'type_id' => $newTypeId,
        ]);

        return redirect()->route('questions.show', ['id' => $question->id])->with('success', 'Type de la question mis à jour avec succès!');
    }

    // ...

    public function editReponses($id)
    {
        $question = Question::with(['type', 'answers'])->findOrFail($id);

        return Inertia::render('Questions/EditReponses', [
            'question' => $question,
        ]);
    }

    public function updateReponses(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // Validez les données du formulaire ici si nécessaire

        // Supprimez les anciennes réponses liées à la question
        $question->answers()->delete();

        // Ajoutez les nouvelles réponses
        $answers = $request->input('answers');
        foreach ($answers as $answer) {
            $question->answers()->create(['content' => $answer['content']]);
        }

        return redirect()->route('questions.show', ['id' => $question->id])->with('success', 'Réponses de la question mises à jour avec succès!');
    }


    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        // Mettez à jour is_deleted à 1 au lieu de supprimer la question
        $question->update(['is_deleted' => 1]);

        return redirect()->route('questions.index')->with('success', 'Question supprimée avec succès!');
    }
}
