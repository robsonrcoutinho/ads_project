<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['titulo', 'url'];
    public $timestamps = false;
}
