<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = "disciplinas";
    public $timestamps = false;
    protected $fillable = ['codigo','nome', 'carga_horaria', 'ementa', 'ativa'];
    protected $softDelete = true;


    public function professors()
    {
        return $this->belongsToMany(Professor::class);

    }

    public function semestres()
    {
      return $this->belongsToMany(Semestre::class);
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);


    }
}
