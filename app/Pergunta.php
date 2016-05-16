<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use adsproject\Resposta;
use adsproject\OpcaoResposta;

class Pergunta extends Model
{
  protected $table = "perguntas";
  public $timestamps = false;
  protected $fillable = ['enunciado','pergunta_fechada'];


  public function resposta(){
    return $this->hasOne(Resposta::class);
  }

  public function avaliacoes(){
    return $this->belongsToMany(Avaliacao::class);
  }

  public function opcoes_resposta(){
    //return $this->hasOne(OpcaoResposta::class);
    //return $this->hasMany(OpcaoResposta::class, 'pergunta_id','id');
    return $this->hasMany(OpcaoResposta::class);
  }
}
