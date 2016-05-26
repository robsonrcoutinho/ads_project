<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
	use SoftDeletes;
    protected $table = "alunos";
    public $timestamps = false;
    protected $fillable =['matricula','nome','email'];
    protected $softDelete  = true;
    
}
