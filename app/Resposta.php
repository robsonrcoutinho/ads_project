<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

/**Classe modelo de Resposta
 * Class Resposta
 * @package adsproject
 */
class Resposta extends Model
{
    protected $table = "respostas";
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
