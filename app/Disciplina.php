<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use adsproject\Professor;

class Disciplina extends Model
{
    use SoftDeletes;

    protected $table = "disciplinas";
    //public $timestamps = false;
    protected $fillable = ['codigo', 'nome', 'carga_horaria', 'ementa'];
    protected $softDelete = true;
    protected $hidden = ['deleted_at'];

    /**
     * Busca professores que lecionam a disciplina
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class);
    }

    /**
     * Busca alunos matriculados na disciplina
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }

    /**
     * Busca pre-requisitos da disciplina
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pre_requisitos()
    {
        return $this->belongsToMany(Disciplina::class, 'pre_requisito', 'disciplina_id', 'pre_requisito_id')->withTimestamps();
    }

    /**
     * Busca disciplinas que a tem como pre-requisito
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'pre_requisito', 'pre_requisito_id', 'disciplina_id');
    }

    /**
     * Busca avaliações relacionadas a disciplina
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function avaliacoes()
    {
        return $this->belongsToMany(Avaliacao::class);
    }

    /**
     * Busca semestres em que a disciplina foi disponibilizada
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semestres()
    {
        return $this->belongsToMany(Semestre::class);
    }

    /**
     * Busca respostas em avaliações relacionadas a essa disciplina
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }
}
