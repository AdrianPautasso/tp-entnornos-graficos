<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';
    protected $primaryKey = 'id';

    protected $casts = [
        'diasSemana' => 'array',
    ];

    protected $fillable = [
        'texto',
        'fechaDesde',
        'fechaHasta',
        'idCategoriaMinima',
        'diasSemana',
        'estado',
        'idLocal',
    ];

    public function categoriaMinima()
    {
        return $this->belongsTo(CategoriaCliente::class, 'codCategoriaMinimaCliente');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'idLocal');
    }

    public function clientes()
    {
        return $this->belongsToMany(Usuario::class, 'usos_promociones', 'idPromocion', 'idCliente')
                    ->withPivot('fechaUso', 'estado')
                    ->withTimestamps();
    }
}
