<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class TipoUsuario extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tipos_usuarios';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['descripcion'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idTipo');
    }
}
