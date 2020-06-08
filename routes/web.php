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
    return view('modulos.inicio');
});
Route::get('/inicio', function () {
    return view('modulos.inicio');
});
Route::get('/createProfile', 'pacienteController@getView');
Route::post('/createProfile', 'pacienteController@getView');
Route::post('/addProfile', 'pacienteController@createProfile');
Route::get('/listaPerfiles', 'pacienteController@getProfiles');
Route::post('/getProfile', 'pacienteController@getProfile');
Route::post('/updateProfile', 'pacienteController@updateProfile');
Route::post('/deleteProfile', 'pacienteController@deleteProfile');
Route::post('/getRecords', 'pacienteController@getRecords');
Route::post('/getRecord', 'pacienteController@getRecord');
Route::get('/createConsult', function (){
    return view('modulos.registrarConsulta');
});