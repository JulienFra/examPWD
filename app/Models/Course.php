<?php
// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'end_time', 'teacher_id'];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_courses')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
