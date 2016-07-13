<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = "respostas";
    public $timestamps = false;
    protected $fillable = ['campo_resposta'];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
