<?php


//TODO El admin debe generar un reporte del uso de promociones. Leer enunciado.

use App\Http\Controllers\LocalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\Role;
use App\Http\Controllers\UsoPromocionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::put('/aprobar/usuarios/{id}', [UsuarioController::class, 'aprobarDueno'])->name('usuarios.aprobar');
    Route::put('/rechazar/usuarios/{id}', [UsuarioController::class, 'rechazarDueno'])->name('usuarios.rechazar');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios');

    Route::get('/locales', [LocalController::class, 'index'])->name('admin.locales');
    Route::delete('/locales/eliminar/{id}', [LocalController::class, 'destroy'])->name('locales.eliminar');
    Route::get('/locales/nuevo', [LocalController::class, 'agregarLocal'])->name('admin.locales_add');
    Route::get('/locales/editar/{id}', [LocalController::class, 'editarLocal'])->name('admin.locales_edit');
    Route::post('/locales', [LocalController::class, 'store'])->name('locales.store');
    Route::put('/locales/{id}', [LocalController::class, 'update'])->name('locales.update');

    Route::get('/novedades', [NovedadController::class, 'index'])->name('admin.novedades');
    Route::delete('/novedades/eliminar/{id}', [NovedadController::class, 'destroy'])->name('novedades.eliminar');
    Route::get('/novedades/nuevo', [NovedadController::class, 'agregarNovedad'])->name('admin.novedades_add');
    Route::get('/novedades/editar/{id}', [NovedadController::class, 'editarNovedad'])->name('admin.novedades_edit');
    Route::post('/novedades', [NovedadController::class, 'store'])->name('novedades.store');
    Route::put('/novedades/{id}', [NovedadController::class, 'update'])->name('novedades.update');
    
    Route::put('/promociones/aprobar/{promocion}', [PromocionController::class, 'update'])->name('promociones.aprobar');
    Route::put('/promociones/denegar/{promocion}', [PromocionController::class, 'update'])->name('promociones.denegar');

    Route::get('/reporte', [UsoPromocionController::class, 'reporte'])->name('admin.reporte');


});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::delete('/promociones/eliminar/{id}', [PromocionController::class, 'destroy'])->name('promociones.eliminar');
    Route::get('/promociones/nuevo', [PromocionController::class, 'agregarPromocion'])->name('dueno.promociones_add');
    Route::post('/promociones', [PromocionController::class, 'store'])->name('promociones.store');
    Route::get('/gestionUsoPromociones',[UsoPromocionController::class, 'getGestionUsoPromociones'])->name('dueno.gestionUsoPromociones');
    Route::put('/usoPromociones/aceptar/{usoPromocion}', [UsoPromocionController::class, 'update'])->name('usoPromociones.aceptar');
    Route::put('/usoPromociones/rechazar/{usoPromocion}', [UsoPromocionController::class, 'update'])->name('usoPromociones.rechazar');
});

Route::middleware(['auth', 'role:1,2'])->group(function () {
    // Rutas accesibles para el rol 1 y el rol 2
});

Route::middleware(['auth', 'role:2,3'])->group(function () {
    Route::delete('/usoPromociones/eliminar/{id}', [UsoPromocionController::class, 'destroy'])->name('usoPromociones.eliminar');
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::post('/usoPromociones', [UsoPromocionController::class, 'store'])->name('usopromociones.store');
});

Route::get('/usoPromociones', [UsoPromocionController::class, 'index'])->name('usoPromociones');
Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones');

/*




// 3. Authentication routes (manual)
// File: routes/web.php







// Protected: any authenticated user
Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Administrador (idTipo == 1)
    Route::middleware('role:1')->group(function() {
        Route::resource('locales', LocalController::class);
        Route::resource('novedades', NovedadController::class);
        Route::get('reportes/uso-promociones', [UsoPromocionController::class, 'report']);
    });

    // Dueño de local (idTipo == 2)
    Route::middleware('role:2')->group(function() {
        Route::resource('promociones', PromocionController::class)->except(['edit','update']);
        Route::post('promociones/{promocion}/aceptar/{uso}', [UsoPromocionController::class, 'aceptar'])->name('usos.aceptar');
        Route::post('promociones/{promocion}/rechazar/{uso}', [UsoPromocionController::class, 'rechazar'])->name('usos.rechazar');
    });

    // Cliente (idTipo == 3)
    Route::middleware('role:3')->group(function() {
        Route::get('promociones/disponibles', [PromocionController::class, 'disponibles']);
        Route::post('promociones/{promocion}/usar', [UsoPromocionController::class, 'usar'])->name('usos.usar');
    });
});

// Public routes for non-registered
Route::get('/', [PromocionController::class, 'indexPublic']);


*/