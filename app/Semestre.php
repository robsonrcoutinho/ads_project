<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = "semestres";
    protected $fillable = ['codigo', 'inicio', 'termino'];
    protected $softDelete = true;
    //public $timestamps = false;
    protected $hidden = ['deleted_at'];

    /**
     * Busca disciplinas oferecidas no semestre
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    /**
     * Busca avaliação do semestre
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avaliacao()
    {
        return $this->hasOne(Avaliacao::class);
    }
}
