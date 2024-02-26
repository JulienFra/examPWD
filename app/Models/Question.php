<?php

// app/Models/Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['have_a_comment'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
