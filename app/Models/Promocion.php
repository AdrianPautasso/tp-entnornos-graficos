<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public static function getVigentesYAprobadas() {
        return self::whereDate('fechaDesde', '<=', now())
            ->whereDate('fechaHasta', '>=', now())
            ->where('estado', 'Aprobada')
            ->latest()
            ->get();
    }

    public static function getVigentesYAprobadasPorLocal($locales) {
        return self::whereIn('idLocal', $locales->pluck('id'))
                    ->where('estado', 'Aprobada')
                    ->whereDate('fechaDesde', '<=', now())
                    ->whereDate('fechaHasta', '>=', now())
                    ->latest()
                    ->get();
    }

    public static function getVigentesYAprobadasPorCategoria($idCategoria) {
        return self::where('idCategoriaMinima', '<=', $idCategoria)
                    ->where('estado', 'Aprobada')
                    ->whereDate('fechaDesde', '<=', now())
                    ->whereDate('fechaHasta', '>=', now())
                    ->latest()
                    ->get();
    
    }
}
