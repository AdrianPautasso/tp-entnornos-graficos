<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'clave',
        'idTipo',
        'idCategoriaCliente'
    ];

    public function tipoUsuario(): BelongsTo
    {
        //Es lo mismo que escribir:
        //return $this->belongsTo(TipoUsuario::class, 'idTipo', 'id');
        //Porque 'id' es el id de TipoUsuario en la tabla TipoUsuario, se especifica si el campo no se llama id.
        return $this->belongsTo(TipoUsuario::class, 'idTipo');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaCliente::class, 'idCategoriaCliente');
    }

    public function locales()
    {
        return $this->hasMany(Local::class, 'idUsuario');
    }

    public function promocionesUsadas()
    {
        return $this->belongsToMany(Promocion::class, 'usos_promociones', 'idUsuario', 'idPromocion')
                    ->withPivot('fechaUso', 'estado')
                    ->withTimestamps();
    }
}
