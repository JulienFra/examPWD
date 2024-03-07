<?php
// app/Models/Teacher.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'token',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
