<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post( '/apiLoginPost', [App\Http\Controllers\AuthController::class, 'apiLoginPost'] )->name( 'api-login-post' );
Route::post( '/apiLogoutPost', [App\Http\Controllers\AuthController::class, 'apiLogoutPost'] )->name( 'api-logout-post' );

Route::post( '/apiObtenerUsuario', [App\Http\Controllers\UsuarioController::class, 'apiObtenerUsuario'] )->name( 'api-obtener-usuario' );
Route::post( '/apiRegistrar', [App\Http\Controllers\UsuarioController::class, 'apiRegistrar'] )->name( 'api-registrar-usuario' );
Route::post( '/apiUpdate', [App\Http\Controllers\UsuarioController::class, 'apiUpdate'] )->name( 'api-update-usuario' );
Route::post( '/apiGuardarPassword', [App\Http\Controllers\UsuarioController::class, 'apiGuardarPassword'] )->name( 'api-guardar-password' );

Route::post( '/apiObtenerPacientes', [App\Http\Controllers\HistoriaController::class, 'apiObtenerPacientes'] )->name( 'api-obtener-pacientes' );
Route::post( '/apiObtenerConsecutivo', [App\Http\Controllers\HistoriaController::class, 'apiObtenerConsecutivo'] )->name( 'api-obtener-consecutivo' );
Route::post( '/apiObtenerHistorias', [App\Http\Controllers\HistoriaController::class, 'apiObtenerHistorias'] )->name( 'api-obtener-historias' );
Route::post( '/apiObtenerHistoria', [App\Http\Controllers\HistoriaController::class, 'apiObtenerHistoria'] )->name( 'api-obtener-historia' );
Route::post( '/apiCrearHistoria', [App\Http\Controllers\HistoriaController::class, 'apiCrearHistoria'] )->name( 'api-crear-historia' );
Route::post( '/apiUpdateHistoria', [App\Http\Controllers\HistoriaController::class, 'apiUpdateHistoria'] )->name( 'api-update-historia' );
Route::post( '/apiFirmarHistoria', [App\Http\Controllers\HistoriaController::class, 'apiFirmarHistoria'] )->name( 'api-firmar-historia' );
