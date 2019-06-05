<?php

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
    return view('welcome');
});

Route::get('/usuario', 'UserController@userIndex')->name('usuarios');

Route::get('/usuario/{user}', 'UserController@userShow')->name('usuarios.detalles')
->where('user','[0-9]+');

Route::get('/usuario/nuevo', 'UserController@createUser')->name('usuarios.nuevo');

Route::post('/usuario/crear', 'UserController@storeUser')->name('usuarios.crear');

Route::get('usuario/{user}/editar', 'UserController@editUser')->name('usuarios.editar');

Route::put('/usuario/{user}', 'UserController@update')->name('usuarios.actualizar');

Route::delete('/usuario/{user}', 'UserController@delete')->name('usuarios.eliminar');