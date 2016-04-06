<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre', 'inicio', 'termino' ];
    public $timestamps = false;

    public function semestre(){
        return $this->belongsTo(Avaliacao::class);
    }

    public function perguntas(){
        return $this->belongsToMany(Pergunta::class);
    }
}
