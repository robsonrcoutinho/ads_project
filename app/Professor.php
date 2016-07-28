<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
 use SoftDeletes;

    protected $table = "professors";
    //public $timestamps = false;
    protected $fillable =['matricula','nome','email','curriculo'];
    protected $softDelete  = true;
    protected $hidden = ['deleted_at'];

    /**
     * Busca disciplinas que o professor leciona
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }
}
