<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['id','titulo', 'url'];
}
