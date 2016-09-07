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
    //Possibilidade de inclusão de método de busca por nome e e-mail
    //Possibilidade de inclusão de método de busca por e-mail
}
