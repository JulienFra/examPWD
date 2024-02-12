<?php
// app/Models/SectionCourse.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionCourse extends Model
{
    protected $fillable = ['section_id', 'course_id'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
