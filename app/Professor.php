<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
 use SoftDeletes;
    protected $table = "professors";
    public $timestamps = false;
    protected $fillable =['matricula','nome','ativo','curriculo'];
    protected $softDelete  = true;

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);

    }
}
