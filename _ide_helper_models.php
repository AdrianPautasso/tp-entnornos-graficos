<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Promocion> $promociones
 * @property-read int|null $promociones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Usuario> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaCliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaCliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaCliente query()
 */
	class CategoriaCliente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Promocion> $promociones
 * @property-read int|null $promociones_count
 * @property-read \App\Models\Usuario|null $usuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Local newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Local newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Local query()
 */
	class Local extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\TipoUsuario|null $tipoUsuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Novedad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Novedad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Novedad query()
 */
	class Novedad extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\CategoriaCliente|null $categoriaMinima
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Usuario> $clientes
 * @property-read int|null $clientes_count
 * @property-read \App\Models\Local|null $local
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promocion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promocion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promocion query()
 */
	class Promocion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Novedad> $novedades
 * @property-read int|null $novedades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Usuario> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoUsuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoUsuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoUsuario query()
 */
	class TipoUsuario extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsoPromocion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsoPromocion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsoPromocion query()
 */
	class UsoPromocion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $codUsuario
 * @property string $nombreUsuario
 * @property string $claveUsuario
 * @property int $codTipoUsuario
 * @property int $codCategoriaCliente
 * @property-read \App\Models\CategoriaCliente|null $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Local> $locales
 * @property-read int|null $locales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Promocion> $promocionesUsadas
 * @property-read int|null $promociones_usadas_count
 * @property-read \App\Models\TipoUsuario|null $tipoUsuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereClaveUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCodCategoriaCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCodTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCodUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereNombreUsuario($value)
 */
	class Usuario extends \Eloquent {}
}

