<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

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

  public function opcaoResposta(){
    return $this->hasOne(OpcaoResposta::class);
  }
}
