<?php

// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name'];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_courses');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses');
    }
}
