<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EleicaoController;
use App\Http\Controllers\VotacaocaoController;

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
 



//Rotas para autenticação do usuario
Route::get('/login-administrador', 'App\Http\Controllers\AuthController@loginAdmin')->name('login-administrador');
Route::post('/login-administrador', 'App\Http\Controllers\AuthController@authenticateAdmin')->name('login-administrador-auth');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::get('/login-eleitor', [AuthController::class, 'loginEleitor'])->name('login-eleitor');
Route::post('/enviar-codigo-sms', [AuthController::class, 'enviarCodigoSMS'])->name('enviar-codigo-sms');
Route::post('/authenticate-eleitor', [AuthController::class, 'authenticateEleitor'])->name('authenticate-eleitor');
Route::get('/registrar-voto', 'App\Http\Controllers\EleicaoController@registrarVoto')->name('registrar-voto');




Route::middleware(['auth'])->group(function () {

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

//Rotas para criação e manutenção da eleição
Route::get('/cadastrar-eleicao', 'App\Http\Controllers\EleicaoController@cadastrar')->name('cadastrar-eleicao');
Route::post('/salvar-eleicao', 'App\Http\Controllers\EleicaoController@salvar')->name('salvar-eleicao');
Route::get('/listar-eleicoes', 'App\Http\Controllers\EleicaoController@listarEleicoes')->name('listar-eleicoes');
Route::get('/editar-eleicao/{id}', 'App\Http\Controllers\EleicaoController@editar')->name('editar-eleicao');
Route::put('/atualizar-eleicao/{id}', 'App\Http\Controllers\EleicaoController@atualizar')->name('atualizar-eleicao');
Route::delete('/excluir-eleicao/{id}', 'App\Http\Controllers\EleicaoController@excluir')->name('excluir-eleicao');
Route::get('/eleicao/{id}', [EleicaoController::class, 'exibirEleicao'])->name('exibir-eleicao');
Route::post('/eleicao/{id}/votar', [VotacaoController::class, 'votar'])->name('votar-eleicao');



/* Route::get('/eleicao/{id}/candidatos/novo', 'CandidatoController@novo')->name('novo-candidato');
Route::post('/eleicao/{id}/candidatos/salvar', 'CandidatoController@salvar')->name('salvar-candidato'); */

//Rotas de cadastro de usuario
Route::get('/create', 'App\Http\Controllers\UserController@create')->name('create');
Route::post('/store', 'App\Http\Controllers\UserController@store')->name('store');

//Rotas de cadastro de candidatos
Route::get('/candidatos', [CandidatoController::class, 'index'])->name('listar-candidatos');
Route::get('/candidatos/create', [CandidatoController::class, 'create'])->name('candidatos.create');
Route::post('/candidatos', [CandidatoController::class, 'store'])->name('candidatos.store');
Route::get('/candidatos/{candidato}', [CandidatoController::class, 'show'])->name('candidatos.show');
Route::get('/candidatos/{candidato}/edit', [CandidatoController::class, 'edit'])->name('editar-candidato');
Route::put('/candidatos/{candidato}', [CandidatoController::class, 'update'])->name('candidatos.update');
Route::delete('/candidatos/{candidato}', [CandidatoController::class, 'destroy'])->name('candidatos.destroy');


});



