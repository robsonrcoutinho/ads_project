<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = ['codigo', 'nome', 'carga_horaria', 'ementa', 'ativa'];
}
