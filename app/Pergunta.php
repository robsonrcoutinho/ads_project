<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pergunta extends Model
{
    use SoftDeletes;

    protected $table = "perguntas";
    protected $fillable = ['enunciado', 'pergunta_fechada'];
    protected $softDelete = true;
    public $timestamps = false;



    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }

    public function avaliacoes()
    {
        return $this->belongsToMany(Avaliacao::class);
    }

    public function opcoes_resposta()
    {
        return $this->hasMany(OpcaoResposta::class);
    }
}
