<?php

// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'grade', 'end_time'];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_courses');
    }
}
