<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\Question;
use App\Models\SingleAnswer;
use App\Models\MultipleAnswer;
use App\Models\OAnswer;

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

        // Créer des questions
        $questions = [
            [
                'content' => 'Quelle est votre couleur préférée?',
                'have_a_comment' => true,
            ],
            [
                'content' => 'Quel est votre animal préféré?',
                'have_a_comment' => false,
            ],
            // Ajoutez d'autres questions au besoin
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'form_id' => $form->id,
                'content' => $questionData['content'],
                'have_a_comment' => $questionData['have_a_comment'],
            ]);

            // Créer des réponses uniques pour chaque question
            SingleAnswer::create([
                'question_id' => $question->id,
                'content' => 'Rouge',
            ]);

            SingleAnswer::create([
                'question_id' => $question->id,
                'content' => 'Bleu',
            ]);

            // Créer des réponses multiples pour chaque question
            MultipleAnswer::create([
                'question_id' => $question->id,
                'content' => 'Chien',
            ]);

            MultipleAnswer::create([
                'question_id' => $question->id,
                'content' => 'Chat',
            ]);

            // Créer des réponses ouvertes pour chaque question
            OAnswer::create([
                'question_id' => $question->id,
                'content' => 'J\'aime les chiens et les chats',
            ]);
        }
    }
}

