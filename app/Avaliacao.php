<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Avaliacao extends Model
{
    use SoftDeletes;

    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre_id', 'inicio', 'termino'];
    protected $softDelete = true;
    public $timestamps = false;

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function perguntas()
    {
        return $this->belongsToMany(Pergunta::class);
    }
}
