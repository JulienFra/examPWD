<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['content', 'have_a_comment'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
