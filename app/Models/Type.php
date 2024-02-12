<?php
// app/Models/Type.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['question_id', 'o_answer_id', 'multiple_answer_id', 'single_answer_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function oAnswer()
    {
        return $this->belongsTo(OAnswer::class);
    }

    public function multipleAnswer()
    {
        return $this->belongsTo(MultipleAnswer::class);
    }

    public function singleAnswer()
    {
        return $this->belongsTo(SingleAnswer::class);
    }
}
