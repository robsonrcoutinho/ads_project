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
    //Possibilidade de incluir m�todo de busca por nome e e-mail
    //Possibilidade de incluir m�todo de busca por e-mail
    //Possibilidade de incluir m�todo de busca por matr�cula
}
