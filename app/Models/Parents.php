<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $fillable = [
        'nomPere',
        'nomMere',
        'adresse',
        'numero_tel',
        'email'
    ];
}
