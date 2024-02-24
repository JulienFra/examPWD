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
}
