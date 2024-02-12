<?php
// app/Models/Form.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
