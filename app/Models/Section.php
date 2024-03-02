<?php
// app/Models/Section.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_sections')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'section_courses')->withTimestamps();
    }
}
