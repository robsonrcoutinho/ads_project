<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**Classe modelo de Aluno
 * Class Aluno
 * @package adsproject
 */
class Aluno extends Model
{
    use SoftDeletes;

    protected $table = "alunos";
    protected $fillable = ['matricula', 'nome', 'email'];
    protected $softDelete = true;
    protected $hidden = ['deleted_at'];

    /**
     * M�todo que busca as disciplinas em que o aluno est� matr�culado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    /**Busca as avalia��es que o aluno fez
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function avaliacoes()
    {
        return $this->belongsToMany(Avaliacao::class);
    }

    /**M�todo para buscar aluno por nome e e-mail
     * @param $query
     * @param $nome
     * @param $email
     * @return mixed
     */
    public function scopeBuscarPorNomeEEmail($query, $nome, $email)
    {
        return $query->where('nome', $nome)
            ->where('email', $email)->get();                 //Busca aluno por nome e email
    }

    /**M�todo que busca aluno por e-mail
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeBuscarPorEmail($query, $email)
    {
        return $query->where('email', $email)->get();          //Busca aluno por email
    }

    /** M�todo que busca aluno por matr�cula
     * @param $query
     * @param $matricula
     * @return mixed
     */
    public function scopeBuscarPorMatricula($query, $matricula)
    {
        return $query->withTrashed()->where('matricula', $matricula)->get();    //Busca aluno por matricula
    }
}