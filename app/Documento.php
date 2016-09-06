<?php

namespace adsproject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**Classe modelo de Documento
 * Class Documento
 * @package adsproject
 */
class Documento extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo'];
    protected $softDelete = true;
    protected $hidden = ['deleted_at'];
}
