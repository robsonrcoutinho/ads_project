<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use adsproject\Professor;

class Disciplina extends Model
{
    use SoftDeletes;

    protected $table = "disciplinas";
    public $timestamps = false;
    protected $fillable = ['codigo', 'nome', 'carga_horaria', 'ementa'];
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
        return $this->hasMany(Disciplina::class, 'pre_requisito', 'pre_requisito_id', 'disciplina_id');
    }

    public function pre_requisitos()
    {
        return $this->belongsToMany(Disciplina::class, 'pre_requisito', 'disciplina_id', 'pre_requisito_id')->withTimestamps();
    }
}
