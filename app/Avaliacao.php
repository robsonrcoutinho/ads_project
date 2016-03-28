<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = ['id', 'semestre', 'inicio', 'termino' ];
}
