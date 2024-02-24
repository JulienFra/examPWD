<?php

namespace Database\Seeders;

// database/seeders/StudentSeeder.php

// database/seeders/StudentSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Section;
use App\Models\Course;
use App\Models\SectionCourse;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $webdevSection = Section::where('name', 'webdev')->first();

        $thibault = Student::create([
            'name' => 'Thibault',
            'surname' => 'Six',
            'email' => 'tsix@example.com',
        ]);

        $jsCourse = Course::where('name', 'js')->first();
        $htmlCourse = Course::where('name', 'html')->first();

        $thibault->sections()->attach($webdevSection->id, ['course_id' => $jsCourse->id]);
        $thibault->sections()->attach($webdevSection->id, ['course_id' => $htmlCourse->id]);
    }
}
