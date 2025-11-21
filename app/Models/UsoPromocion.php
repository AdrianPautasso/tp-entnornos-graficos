<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoPromocion extends Model
{
//No lleva id porque es una tabla pivotante.
    protected $table = 'usos_promociones';
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idUsuario',
        'idPromocion',
        'fechaUso',
        'estado',
    ];

    public function promocion() {
        return $this->belongsTo(Promocion::class, 'idPromocion');
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public static function allByUser($idUsuario)
    {
        return self::where('idUsuario',$idUsuario)->with('promocion')->get();
    }
}