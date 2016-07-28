<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = "respostas";
    //public $timestamps = false;
    protected $fillable = ['campo_resposta'];

    /**
     * Busca pergunta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    /**
     * Busca avaliação relacionada à resposta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }

    /**
     * Busca a disciplina que se relaciona à resposta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
