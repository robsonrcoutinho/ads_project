<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**Classe modelo de Professor
 * Class Professor
 * @package adsproject
 */
class Professor extends Model
{
    use SoftDeletes;

    protected $table = "professors";
    protected $fillable = ['matricula', 'nome', 'email', 'curriculo'];
    protected $softDelete = true;
    protected $hidden = ['deleted_at'];

    /**
     * Busca disciplinas que o professor leciona
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    /**Método para buscar professor por nome e e-mail
     * @param $query
     * @param $nome
     * @param $email
     * @return mixed
     */
    public function scopeBuscarPorNomeEEmail($query, $nome, $email)
    {
        return $query->where('nome', $nome)
            ->where('email', $email)->get();                 //Busca professor por nome e email

    }

    /**Método que busca professor por e-mail
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeBuscarPorEmail($query, $email)
    {
        return $query->where('email', $email)->get();       //Busca professor por email
    }
}
