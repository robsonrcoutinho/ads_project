<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    //
    protected $fillable = ['idAviso', 'titulo', 'mensagem'];
}
