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
        // Create types
        $openType = Type::create(['name' => 'Ouverte']);
        $singleChoiceType = Type::create(['name' => 'Choix unique']);
        $multipleChoiceType = Type::create(['name' => 'Choix multiple']);

        // Seed questions
        $openQuestion = Question::create([
            'content' => 'Pourquoi la vie ?',
            'have_a_comment' => true,
            'type_id' => $openType->id,
        ]);

        $singleChoiceQuestion = Question::create([
            'content' => 'Quelles sont tes matières préférées à l\'école ?',
            'have_a_comment' => false,
            'type_id' => $singleChoiceType->id,
        ]);

        $multipleChoiceQuestion = Question::create([
            'content' => 'Quel animal aimes-tu le plus ?',
            'have_a_comment' => false,
            'type_id' => $multipleChoiceType->id,
        ]);

        // Add answers for multiple-choice question
        $this->addMultipleChoiceAnswers($multipleChoiceQuestion);
    }

    protected function addMultipleChoiceAnswers(Question $question)
    {
        $choices = ['Chat', 'Chien', 'Cheval'];

        foreach ($choices as $choice) {
            $question->answers()->create(['content' => $choice]);
        }
    }
}
