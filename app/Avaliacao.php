<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre_id', 'inicio', 'termino' ];
    protected $softDelete = true;
    public $timestamps = false;

    public function semestre(){
           return $this->belongsTo(Semestre::class);
    }

    public function perguntas(){
        return $this->belongsToMany(Pergunta::class);
    }
}
