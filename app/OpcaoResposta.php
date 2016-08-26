<?php

namespace adsproject;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/** Classe modelo de opções de resposta
 * Class OpcaoResposta
 * @package adsproject
 */
class OpcaoResposta extends Model
{
    use SoftDeletes;

    protected $table = "opcao_resposta";
    protected $softDelete = true;
    protected $fillable = ['resposta_opcao'];
    protected $hidden = ['deleted_at'];

    /**
     * Busca pergunta que se relaciona com a opção de resposta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
