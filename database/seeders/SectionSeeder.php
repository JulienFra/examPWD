<?php

namespace Database\Seeders;

// database/seeders/SectionSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Course;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $webdevSection = Section::create([
            'name' => 'webdev',
        ]);

        $phpCourse = Course::create([
            'name' => 'php',
            'end_time' => now(),
        ]);

        $jsCourse = Course::create([
            'name' => 'js',
            'end_time' => now(),
        ]);

        $htmlCourse = Course::create([
            'name' => 'html',
            'end_time' => now(),
        ]);

        // Attacher les cours à la section "webdev" en utilisant la table intermédiaire
        $webdevSection->courses()->attach([$phpCourse->id, $jsCourse->id, $htmlCourse->id]);
    }
}
