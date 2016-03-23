<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable = ['codigo','inicio', 'termino'];
}
