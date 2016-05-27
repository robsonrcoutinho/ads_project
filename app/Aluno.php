<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
	use SoftDeletes;
    protected $table = "alunos";
    public $timestamps = false;
    protected $fillable =['matricula','nome','email'];
    protected $softDelete  = true;
    protected $hidden = ['deleted_at'];
}
