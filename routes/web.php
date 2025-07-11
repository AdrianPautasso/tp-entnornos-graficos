<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\UsoPromocionController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


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