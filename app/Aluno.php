<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use adsproject\Disciplina;

class Aluno extends Model
{
	use SoftDeletes;
    protected $table = "alunos";
    public $timestamps = false;
    protected $fillable =['matricula','nome','email'];
    protected $softDelete  = true;
    protected $hidden = ['deleted_at'];

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }
}
