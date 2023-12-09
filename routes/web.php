<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', [App\Http\Controllers\AuthController::class, 'loginForm'] )->name( 'sda_login' );
Route::post( '/sda_login', [App\Http\Controllers\AuthController::class, 'loginPost'] )->name( 'post_login' );
Route::get( '/registro', [App\Http\Controllers\UsuarioController::class, 'registro'] )->name( 'registro' );
Route::post( '/registrar', [App\Http\Controllers\UsuarioController::class, 'registrar'] )->name( 'registrar' );

Route::group(['middleware' => ['auth']], function () {

    Route::get( '/logout', [App\Http\Controllers\AuthController::class, 'logoutGet'] )->name( 'get_logout' );
    Route::post( '/logout', [App\Http\Controllers\AuthController::class, 'logoutPost'] )->name( 'logout_post' );
    Route::get( '/update-password', [App\Http\Controllers\UsuarioController::class, 'updatePassword'] )->name( 'update-password' );
    Route::patch( '/guardar-password/{usuario}', [App\Http\Controllers\UsuarioController::class, 'guardarPassword'] )->name( 'guardar-password' );

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/configuracion/{user}', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('configuracion.index');
    Route::patch('/configuracion-update/{user}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('configuracion.update');

    Route::get('/historias', [App\Http\Controllers\HistoriaController::class, 'index'])->name('historias.index');
    Route::get('/historias-consecutivo', [App\Http\Controllers\HistoriaController::class, 'consecutivo'])->name('historias.consecutivo');
    Route::post('/historias-store', [App\Http\Controllers\HistoriaController::class, 'store'])->name('historias.store');
    Route::get('/historias-edit/{historia}', [App\Http\Controllers\HistoriaController::class, 'edit'])->name('historias.edit');
    Route::get('/historias-show/{historia}', [App\Http\Controllers\HistoriaController::class, 'show'])->name('historias.show');
    Route::post('/historias-firmar/{historia}', [App\Http\Controllers\HistoriaController::class, 'firmar'])->name('historias.firmar');
    Route::patch('/historias-update/{historia}', [App\Http\Controllers\HistoriaController::class, 'update'])->name('historias.update');
    Route::delete('/historias-delete', [App\Http\Controllers\HistoriaController::class, 'delete'])->name('historias.delete');

});