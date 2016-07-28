<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
	use SoftDeletes;
    protected $table = "alunos";
    //public $timestamps = false;
    protected $fillable =['matricula','nome','email'];
    protected $softDelete  = true;
    protected $hidden = ['deleted_at'];

    /**
     * M�todo que busca as disciplinas em que o aluno est� matr�culado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }
}
