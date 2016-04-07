<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre_id', 'inicio', 'termino', 'semestre' ];
    protected $softDelete = true;
    public $timestamps = false;

    public function semestre(){
            //$this->semestre()->getCodigo();
           return $this->belongsTo(Avaliacao::class);
    }

    public function perguntas(){
        return $this->belongsToMany(Pergunta::class);
    }
}
