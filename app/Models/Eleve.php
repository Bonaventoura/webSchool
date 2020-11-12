<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $fillable = [
        'nom',
        'prenoms',
        'sexe',
        'date_nssce',
        'adresse',
        'matricule',
        'photo_passport'
    ];
}
