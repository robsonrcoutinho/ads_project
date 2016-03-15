<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = ['matricula', 'nome', 'ativo', 'curriculo'];
}
