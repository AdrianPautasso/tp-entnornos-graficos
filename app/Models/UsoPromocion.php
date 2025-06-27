<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoPromocion extends Model
{
//No lleva id porque es una tabla pivotante.
    protected $table = 'usos_promociones';
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = null;
    
    protected $fillable = [
        'idUsuario',
        'idPromocion',
        'fechaUso',
        'estado',
    ];
}