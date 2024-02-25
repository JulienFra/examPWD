<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Section;
use App\Models\Course;
use App\Models\SectionCourse;
use App\Models\StudentCourse;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Trouver la section "webdev"
        $webdevSection = Section::where('name', 'webdev')->first();

        // Créer un nouvel étudiant
        $thibault = Student::create([
            'name' => 'Thibault',
            'surname' => 'Six',
            'email' => 'tsix@example.com',
        ]);

        // Trouver les cours
        $jsCourse = Course::where('name', 'js')->first();
        $htmlCourse = Course::where('name', 'html')->first();

        // Lier l'étudiant à la section "webdev"
        $thibault->sections()->attach($webdevSection->id);

        // Lier l'étudiant aux cours
        $thibault->courses()->attach($jsCourse->id);
        $thibault->courses()->attach($htmlCourse->id);
    }
}
