<?php

namespace adsproject;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpcaoResposta extends Model
{
    use SoftDeletes;

    protected $table = "opcao_resposta";
    protected $softDelete = true;
    //public $timestamps = false;
    protected $fillable = ['resposta_opcao'];
    protected $hidden = ['deleted_at'];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
