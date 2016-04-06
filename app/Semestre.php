<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = "semestres";
    protected $fillable = ['codigo','inicio', 'termino'];
    public $timestamps = false;


    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);

    }

    public function avaliacao(){
        return $this->hasOne(Avaliacao::class);
    }


}
