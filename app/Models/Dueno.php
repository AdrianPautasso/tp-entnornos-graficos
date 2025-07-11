<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dueno extends Usuario
{
    public static function query()
    {
        return parent::query()->where('idTipo', 2);
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'idUsuario');
    }
}