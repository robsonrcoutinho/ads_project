<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use adsproject\Pergunta;

class OpcaoResposta extends Model
{
    protected $table = "opcao_resposta";
    public $timestamps = false;
    //protected $fillable = ['resposta_opcao_id'];
    protected $fillable = ['resposta_opcao'];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
