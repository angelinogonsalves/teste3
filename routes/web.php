<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');


Route::get('/login', [AuthController::class,'login'])->name('login');

Route::post('/loga', [AuthController::class,'loga'])->name('loga');
/*
Route::get('/register', [AuthController::class,'register'])->name('register');
*/
Route::get('/recuperar-senha', [AuthController::class,'recuperarSenha'])->name('recuperar-senha');

Route::middleware(['auth'])->group(function () {
  
    //TELA HOME ALUNO
    Route::group(array('prefix' => 'aluno'), function(){
        Route::get('/home', [AlunoController::class,'inicio'])->name('home');
        Route::get('/detalhes-pedido', [AlunoController::class,'detalhesPedido'])->name('detalhes-pedido');
    });

    //criar os middlewares de admin.------------
    //Route::get('/usuarios', [UserController::class,'index'])->name('users');

    Route::group(array('prefix' => 'usuarios'), function(){
        Route::get('/', [UserController::class,'index'])->name('usuarios');
        Route::get('/cadastro/{user?}', [UserController::class,'verUsuario'])->name('ver-usuario');
        Route::post('/excluir/{user}', [UserController::class,'excluirUsuario'])->name('excluir-usuario');
        Route::post('/salvar', [UserController::class,'salvaUsuario'])->name('salvar-usuario');
    });

    Route::group(array('prefix' => 'produtos'), function(){
        Route::get('/', [ProdutoController::class,'index'])->name('produtos');
        Route::get('/cadastro/{produto?}', [ProdutoController::class,'verProduto'])->name('criar-produto');
        Route::get('/detalhes', [ProdutoController::class,'detalhes'])->name('detlhes');
        Route::post('/excluir', [ProdutoController::class,'criar'])->name('produtos');
        Route::post('/salvar', [ProdutoController::class,'salvarProduto'])->name('produtos');
    });

    Route::group(array('prefix' => 'unidades'), function(){
        Route::get('/', [UnidadeController::class,'index'])->name('unidades');
        Route::get('/cadastro/{unidade?}', [UnidadeController::class,'verUnidade'])->name('ver-unidade');    
        Route::post('/excluir/{unidade}', [UnidadeController::class,'excluirUnidade'])->name('excluir-unidade');
        Route::post('/salvar', [UnidadeController::class,'salvaUnidade'])->name('salvar-unidade');
    });
    Route::group(array('prefix' => 'pedidos'), function(){
        Route::get('/', [PedidoController::class,'index'])->name('pedidos');
        Route::get('/criar', [PedidoController::class,'editPedido'])->name('criar');
        Route::post('/excluir', [PedidoController::class,'excluir'])->name('excluir');
        Route::post('/salvar', [PedidoController::class,'salvaUnidade'])->name('salvar');
    });
});


