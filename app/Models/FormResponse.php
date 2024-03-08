<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{

    use HasFactory;

    protected $fillable = ['student_course_id', 'question_id', 'response', 'comment'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class);
    }
}
