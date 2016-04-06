<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table = "avisos";
    protected $fillable = ['titulo', 'mensagem'];
    public $timestamps = false;
}
