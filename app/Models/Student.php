<?php
// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // ...
    use HasFactory;

    public function student_sections()
    {
        return $this->belongsToMany(StudentSection::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'student_sections')->with('sectionCourses.course');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_sections');
    }

    // ...
}
