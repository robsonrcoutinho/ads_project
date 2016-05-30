<?php

namespace adsproject;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table = "avisos";
    protected $fillable = ['titulo', 'mensagem'];
    //public $timestamps = false;

    public function scopeAntigos($query)
    {
        return $query->whereDate('created_at', '<=', Carbon::now()->subDay(7));
    }
}
