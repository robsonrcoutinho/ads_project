<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professors";
    public $timestamps = false;
    protected $fillable =['matricula','nome','ativo','curriculo'];
    protected $softDelete = true;

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);

    }
}
