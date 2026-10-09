<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Novedad extends Model
{
    protected $table = 'novedades';

    protected $primaryKey = 'id';

    protected $fillable = [
        'texto',
        'fechaDesde',
        'fechaHasta',
        'idCategoriaMinima'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaCliente::class, 'idCategoriaMinima');
    }

    public static function getVigentes()
    {
        $hoy = Carbon::today();
        return self::whereDate('fechaDesde', '<=', $hoy)
                    ->whereDate('fechaHasta', '>=', $hoy)
                    ->latest()
                    ->get();
    }

    public static function getVigentesPorCategoria($idCategoria) {
        $hoy = Carbon::today();
        return self::where('idCategoriaMinima', '<=', $idCategoria)
                    ->whereDate('fechaDesde', '<=', now())
                    ->whereDate('fechaHasta', '>=', now())
                    ->latest()
                    ->get();
    }
}

