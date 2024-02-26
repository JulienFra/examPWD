<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test@example2.com',
        ]);

        // Seed questions
        $question1 = Question::create([
            'content' => 'Quel est le nom du professeur qui a dispensé ce cours? ',
            'have_a_comment' => true,
        ]);

        $question2 = Question::create([
            'content' => 'A quelle fréquence avez-vous été présent(e) à ce cours? ',
            'have_a_comment' => false,
        ]);

        $question3 = Question::create([
            'content' => 'De manière générale, comment évalueriez-vous... (Merci de cocher une case par question)',
            'have_a_comment' => false,
        ]);

        $question4 = Question::create([
            'content' => 'Ajoutez, si vous le souhaitez, un commentaire par rapport à la grille ci-dessus.',
            'have_a_comment' => true,
        ]);

        $question5 = Question::create([
            'content' => 'Le cours vous a-t-il paru difficile?',
            'have_a_comment' => false,
        ]);

        $question6 = Question::create([
            'content' => 'Que vous a apporté le cours? Qu\'avez-vous appris? ',
            'have_a_comment' => true,
        ]);

        $question7 = Question::create([
            'content' => 'Sous quel format avez-vous reçu les notes de cours?',
            'have_a_comment' => false,
        ]);

        $question8 = Question::create([
            'content' => 'Selon vous, l\'enseignement proposé développe-t-il votre faculté d\'adaptation à de nouvelles matières? Ce cours vous a-t-il apporté de nouvelles techniques de travail et d\'apprentissage que vous avez pu appliquer à d\'autres cours?',
            'have_a_comment' => false,
        ]);

        $question9 = Question::create([
            'content' => 'Avez-vous eu connaissance des objectifs du cours?',
            'have_a_comment' => false,
        ]);

        $question10 = Question::create([
            'content' => 'Les objectifs, tels qu\'énoncés, ont-ils été atteints?',
            'have_a_comment' => true,
        ]);

        $question11 = Question::create([
            'content' => 'Commentez votre choix à la question précédente',
            'have_a_comment' => true,
        ]);

        $question12 = Question::create([
            'content' => 'Que pensez-vous de la quantité de matière vue pour ce cours dans le cadre du temps attribué?',
            'have_a_comment' => false,
        ]);

        $question13 = Question::create([
            'content' => 'Comment trouvez-vous... (l\'information recue avant les tests ou l\'examen, les explications sur la cotation des réponses aux tests, les explications sur la cotation des réponses à l\'examen)',
            'have_a_comment' => false,
        ]);

        $question14 = Question::create([
            'content' => 'Le mode d\'évaluation pour ce cours est-il pertinent?',
            'have_a_comment' => false,
        ]);

        $question15 = Question::create([
            'content' => 'Commentez votre réponse à la question précédente',
            'have_a_comment' => true,
        ]);

        $question16 = Question::create([
            'content' => 'Vous propose-t-on des solutions pour remédier à vos éventuelles faiblesses?',
            'have_a_comment' => false,
        ]);

        $question17 = Question::create([
            'content' => 'Qu\'avez-vous apprécié le plus durant la formation?',
            'have_a_comment' => true,
        ]);

        $question18 = Question::create([
            'content' => 'Qu\'avez-vous apprécié le moins durant la formation? ',
            'have_a_comment' => true,
        ]);

        $question19 = Question::create([
            'content' => 'Avez-vous des remarques à formuler concernant ce cours?',
            'have_a_comment' => true,
        ]);

        // Seed types
        Type::create([
            'question_id' => $question1->id,
            'o_answer_id' => 1, // Assuming you have an existing OAnswer with id 1
            'multiple_answer_id' => null, // Adjust this value accordingly
            'single_answer_id' => null, // Adjust this value accordingly
        ]);

        Type::create([
            'question_id' => $question2->id,
            'o_answer_id' => 1, // Assuming you have an existing OAnswer with id 1
            'multiple_answer_id' => null, // Adjust this value accordingly
            'single_answer_id' => null, // Adjust this value accordingly
        ]);

        // Add more types here if needed...
    }
}
