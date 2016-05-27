<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = "semestres";
    protected $fillable = ['codigo', 'inicio', 'termino'];
    protected $softDelete = true;
    public $timestamps = false;
    protected $hidden = ['deleted_at'];


    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    public function avaliacao()
    {
        return $this->hasOne(Avaliacao::class);
    }
}
