<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = "tokens";
    protected $fillable = ['token_name'];
    public $timestamps = false;


}
