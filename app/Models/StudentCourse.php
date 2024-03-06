<?php
// app/Models/StudentSection.php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = ['student_id', 'course_id',  'token'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function token()
    {
        return $this->belongsTo(Course::class);
    }
}
