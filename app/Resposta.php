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

    /**Método que realiza busca de respostas especificas
     * @param $query
     * @param $avaliacao_id
     * @param $pergunta_id
     * @param $disciplina_id
     * @return mixed
     */
    public function scopeEspecificas($query, $avaliacao_id, $pergunta_id, $disciplina_id)
    {
        return $query->where('avaliacao_id', $avaliacao_id)
            ->where('pergunta_id', $pergunta_id)
            ->where('disciplina_id', $disciplina_id)->get();
    }
}