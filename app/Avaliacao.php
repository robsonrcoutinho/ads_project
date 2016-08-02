<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Avaliacao extends Model
{
    use SoftDeletes;

    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre_id', 'inicio', 'termino'];
    protected $softDelete = true;
    //public $timestamps = false;
    protected $hidden = ['deleted_at'];

    /**
     * Busca o semestre relacionado a avaliação
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    /**
     * Busca perguntas da avaliação
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perguntas()
    {
        return $this->belongsToMany(Pergunta::class);
    }

    /**
     * Busca respostas da avaliação
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }

    /**
     * Busca disciplinas da avaliadas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    /**
     * Busca alunos que responderam à avaliação
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }

    /**
     * Busca avaliação aberta
     * @param $query
     * @return mixed
     */
    public function scopeAberta($query)
    {
        return $query->whereDate('inicio', '<=', date('Y-m-d'))
            ->whereDate('termino', '>=', date('Y-m-d'))
            ->with('perguntas.opcoes_resposta');
    }
}
