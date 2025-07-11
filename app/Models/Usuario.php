<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Authenticatable
{

    protected $table = 'usuarios';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'password',
        'idTipo',
        'idCategoriaCliente',
        'aprobado'
    ];

    protected static function booted()
    {
                
        static::creating(function ($usuario) {
            $tipo = TipoUsuario::find($usuario->idTipo);

            if ($tipo && strtolower($tipo->nombre) === 'dueño') {
                $usuario->aprobado = false;
            } else {
                $usuario->aprobado = true;
            }
        });
    }

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
