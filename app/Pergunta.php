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
    //public $timestamps = false;
    protected $hidden = ['deleted_at'];

    /**
     * Busca respostas � pergunta
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }

    /**
     * Busca avalia��es que t�m a pergunta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function avaliacoes()
    {
        return $this->belongsToMany(Avaliacao::class);
    }

    /**
     * Busca as op��es de resposta � pergunta, quando fechada
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opcoes_resposta()
    {
        return $this->hasMany(OpcaoResposta::class);
    }
}
