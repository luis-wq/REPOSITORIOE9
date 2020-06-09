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
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/actualizarPModificacion', 'AutoresController@actualizarPModificacion')->name('actualizarPModificacion')->middleware('auth');
Route::get('/actualizarPIndependencia', 'AutoresController@actualizarPIndependencia')->name('actualizarPIndependencia')->middleware('auth');
Route::get('/actualizarPSubSeccion', 'AutoresController@actualizarPSubSeccion')->name('actualizarPSubSeccion')->middleware('auth');
Route::get('/actualizarPSeccion', 'AutoresController@actualizarPSeccion')->name('actualizarPSeccion')->middleware('auth');
Route::get('/obtenerSecciones', 'AutoresController@obtenerSecciones')->name('obtenerSecciones')->middleware('auth');
Route::get('/index_difusor', 'ContentsController@indexDifusor')->name('contents_difusor')->middleware('auth');
Route::get('/obtenerVersion','ContentsController@obtenerVersion')->name('obtenerVersion')->middleware('auth');
Route::get('/subscribirte/{id_section}','SectionsController@subscribirte')->name('subscribirte')->middleware('auth');
Route::get('/aprobar/{id}','ContentsController@aprobar')->name('aprobar')->middleware('auth');
Route::put('/aprobado/{id}', 'ContentsController@actualizaAprobado')->name('aprobado')->middleware('auth');
Route::resource('autores','AutoresController')->middleware('auth');
Route::resource('subscripcions','SubscripcionsController')->middleware('auth');
Route::resource('contents','ContentsController'); //Dejamos sin middleware ya que el usuario anonimo debe poder ver el contenido
Route::resource('sections','SectionsController'); 
Route::get('/foo', function () {
    Artisan::call('storage:link');
}); //Para crear el link a la carpeta storage y poder subir imagenes al servidor.
Route::get('/updateapp', function()
{
    \Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
}); //Para reconstruir el diagrama de clases de laravel y agregar las clases de los servicios
Auth::routes();