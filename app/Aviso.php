<?php

namespace adsproject;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table = "avisos";
    protected $fillable = ['titulo', 'mensagem'];

    /**
     * Busca avisos antigos (com 7 dias ou mais)
     * @param $query
     * @return mixed
     */
    public function scopeAntigos($query)
    {
        return $query->whereDate('created_at', '<=', Carbon::now()->subDay(7));
    }
}
