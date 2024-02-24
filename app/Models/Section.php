<?php
// app/Models/Section.php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Section extends Model
{
    protected $fillable = ['name'];

    public function sectionCourses()
    {
        return $this->hasMany(SectionCourse::class, 'section_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'section_courses');
    }
}
