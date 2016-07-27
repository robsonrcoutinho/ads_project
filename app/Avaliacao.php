<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Avaliacao extends Model
{
    use SoftDeletes;

    protected $table = "avaliacaos";
    protected $fillable = ['id', 'semestre_id', 'inicio', 'termino'];
    protected $softDelete = true;
    //public $timestamps = false;
    protected $hidden = ['deleted_at'];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function perguntas()
    {
        return $this->belongsToMany(Pergunta::class);
    }

    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function scopeAberta($query)
    {
        return $query->whereDate('inicio', '<=', date('Y-m-d'))
            ->whereDate('termino', '>=', date('Y-m-d'))
            ->with('perguntas.opcoes_resposta');
    }
}
