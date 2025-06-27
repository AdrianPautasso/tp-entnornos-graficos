<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaCliente extends Model
{
    use HasFactory;

    protected $table = 'categorias_clientes';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['descripcion', 'nivel'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idCategoriaCliente');
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'idCategoriaMinima');
    }

    public function novedades()
    {
        return $this->hasMany(Novedad::class, 'idCategoriaMinima');
    }
}
