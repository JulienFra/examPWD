<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\Question;
use App\Models\Type;
use App\Models\Answer;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un formulaire
        $form = Form::create();


        // Créer les types de questions
        $types = [
            ['name' => 'open'],
            ['name' => 'multiple'],
            ['name' => 'single'],
        ];

        foreach ($types as $typeData) {
            Type::create($typeData);
        }

        // Créer des exemples de questions avec différents types
        $questions = [
            [
                'content' => 'Quelle est votre couleur préférée?',
                'type' => 'single',
                'answers' => ['Rouge', 'Bleu', 'Vert'],
                'have_a_comment' => true, // Ajout de la valeur pour have_a_comment
            ],
            [
                'content' => 'Quels animaux préférez-vous?',
                'type' => 'multiple',
                'answers' => ['Chien', 'Chat', 'Oiseau'],
                'have_a_comment' => true, // Ajout de la valeur pour have_a_comment
            ],
            [
                'content' => 'Quel est votre animal préféré?',
                'type' => 'open',
                'answers' => ['Chien', 'Chat', 'Oiseau'],
                'have_a_comment' => false,
            ],
            // Ajoutez d'autres questions au besoin
        ];

        foreach ($questions as $questionData) {
            // Récupérer l'ID du type de question
            $typeId = Type::where('name', $questionData['type'])->first()->id;

            // Créer la question
            $question = Question::create([
                'content' => $questionData['content'],
                'type_id' => $typeId,
                'have_a_comment' => $questionData['have_a_comment'], // Attribuer la valeur à have_a_comment
            ]);

            // Ajouter les réponses associées à la question
            foreach ($questionData['answers'] as $answerContent) {
                Answer::create([
                    'course_id' => 1,
                    'question_id' => $question->id,
                    'content' => $answerContent,
                ]);
            }
        }
    }
}
