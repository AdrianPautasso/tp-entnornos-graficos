<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locales';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
        'ubicacion',
        'rubro',
        'idUsuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'idLocal');
    }
}
