<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Course;
use App\Models\Teacher;

class SectionSeeder extends Seeder
{
    public function run()
    {
        // Créer un enseignant
        $brunoMartin = Teacher::create([
            'name' => 'Bruno Martin',
        ]);

        // Créer une section
        $webdevSection = Section::create([
            'name' => 'webdev',
        ]);

        // Créer trois cours et les lier à l'enseignant
        $phpCourse = Course::create([
            'name' => 'php',
            'end_time' => now(),
            'teacher_id' => $brunoMartin->id,
        ]);

        $jsCourse = Course::create([
            'name' => 'js',
            'end_time' => now(),
            'teacher_id' => $brunoMartin->id,
        ]);

        $htmlCourse = Course::create([
            'name' => 'html',
            'end_time' => now(),
            'teacher_id' => $brunoMartin->id,
        ]);

        // Attacher les cours à la section "webdev" en utilisant la table intermédiaire
        $webdevSection->courses()->attach([$phpCourse->id, $jsCourse->id, $htmlCourse->id]);
    }
}
