<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EleicaoController;
use App\Http\Controllers\HomeController;
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
    return view('index');
});

//Rotas de cadastro de usuario
Route::get('/create', 'App\Http\Controllers\UserController@create')->name('create');
Route::post('/create', 'App\Http\Controllers\UserController@store')->name('create');

//Rotas para autenticação do usuario
Route::get('/login-administrador', 'App\Http\Controllers\AuthController@loginAdmin')->name('login-administrador');
Route::post('/login-administrador', 'App\Http\Controllers\AuthController@authenticateAdmin')->name('login-administrador');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

//Rotas para criação e manutenção da eleição
Route::get('/cadastrar-eleicao', 'App\Http\Controllers\EleicaoController@cadastrar')->name('cadastrar-eleicao');
Route::post('/salvar-eleicao', 'App\Http\Controllers\EleicaoController@salvar')->name('salvar-eleicao');
Route::get('/listar-eleicoes', 'App\Http\Controllers\EleicaoController@listarEleicoes')->name('listar-eleicoes');
Route::get('/editar-eleicao/{id}', 'App\Http\Controllers\EleicaoController@editar')->name('editar-eleicao');
Route::delete('/excluir-eleicao/{id}', 'App\Http\Controllers\EleicaoController@excluir')->name('destroy');

/* Route::get('/eleicao/{id}/candidatos/novo', 'CandidatoController@novo')->name('novo-candidato');
Route::post('/eleicao/{id}/candidatos/salvar', 'CandidatoController@salvar')->name('salvar-candidato'); */


});



