<?php
// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'surname', 'email'];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'student_sections')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')->withTimestamps();
    }
    public function updateCourses(array $sectionIds)
    {
        $this->courses()->sync([]);

        foreach ($sectionIds as $sectionId) {
            $section = Section::find($sectionId);
            if ($section) {
                $this->courses()->syncWithoutDetaching($section->courses);
            }
        }
    }
}
