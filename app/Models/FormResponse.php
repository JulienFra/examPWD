<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{

    use HasFactory;

    protected $fillable = ['registered_id', 'question_id', 'response', 'comment'];

    // Ajoute les relations avec les modèles Registered et Question si nécessaire
    public function registered()
    {
        return $this->belongsTo(Registered::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
