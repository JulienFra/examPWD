<?php

namespace Database\Seeders;

// database/seeders/StudentSeeder.php

// database/seeders/StudentSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Section;
use App\Models\Course;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Récupérer la section "webdev"
        $webdevSection = Section::where('name', 'webdev')->first();

        // Créer l'élève Thibault
        $thibault = Student::create([
            'name' => 'Thibault',
            'surname' => 'Six',
            'email' => 'tsix@example.com',
        ]);

        // Récupérer les cours "js" et "html"
        $jsCourse = Course::where('name', 'js')->first();
        $htmlCourse = Course::where('name', 'html')->first();

        // Attacher les cours à l'élève Thibault dans la section "webdev"
        $thibault->sections()->attach([
            $webdevSection->id => ['course_id' => $jsCourse->id],
            $webdevSection->id => ['course_id' => $htmlCourse->id],
        ]);
    }
}
