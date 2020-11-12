<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $fillable = [
        'nom',
        'prenoms',
        'sexe',
        'lieu_nssce',
        'date_nssce',
        'adresse',
        'nationalite',
        'numero_tel',
        'email',
        'photo',
        'code'
    ];
}
