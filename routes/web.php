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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home','HomeController@index')->name('home');

Route::resource('registro', 'RegistroController');
Route::resource('usuario', 'UserController');
Route::resource('alumno', 'AlumnoController');
Route::get('editar-usuario/{id}','UserController@edit');
Route::get('editar-alumno/{CODE_A}','AlumnoController@edit');

Route::get('entrega-mostrar/{alumno}/{registro}','RegistroController@mostrarEntrega');
