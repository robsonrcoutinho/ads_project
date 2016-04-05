<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class OpcaoResposta extends Model
{
    protected $table = "opcao_resposta";
    public $timestamps = false;
    protected $fillable = ['resposta_opcao_id'];


    public function pergunta(){
        return $this->belongsTo(Pergunta::class);
    }
}
