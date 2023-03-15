<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModalidadeController;
use App\Http\Controllers\PagSeguroController;
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


Route::get('/login', [AuthController::class,'login'])->name('login');

Route::post('/loga', [AuthController::class,'loga'])->name('loga');

Route::get('/register', [AuthController::class,'register'])->name('register');

Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::post('/registra', [AuthController::class,'registra'])->name('registra');

Route::get('/recuperar-senha', [AuthController::class,'recuperarSenha'])->name('recuperar-senha');

Route::middleware(['auth'])->group(function () {
      
    Route::get('/', [HomeController::class,'index'])->name('home');
    

    //TELA HOME ALUNO
    Route::group(array('prefix' => 'aluno'), function(){
      //  Route::get('/home', [AlunoController::class,'inicio'])->name('home-aluno');
        Route::get('/detalhes-pedido/{pedido}', [AlunoController::class,'detalhesPedido'])->name('detalhes-pedido');
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
        Route::post('/excluir/{produto}', [ProdutoController::class,'excluirProduto'])->name('excluir-produto');
        Route::post('/salvar', [ProdutoController::class,'salvarProduto'])->name('salvar-produto');
        Route::get('/listaporunidade/{unidade}', [ProdutoController::class,'listaPorUnidade'])->name('listaporunidade');
    });

    Route::group(array('prefix' => 'unidades'), function(){
        Route::get('/', [UnidadeController::class,'index'])->name('unidades');
        Route::get('/cadastro/{unidade?}', [UnidadeController::class,'verUnidade'])->name('ver-unidade');    
        Route::post('/excluir/{unidade}', [UnidadeController::class,'excluirUnidade'])->name('excluir-unidade');
        Route::post('/salvar', [UnidadeController::class,'salvaUnidade'])->name('salvar-unidade');
    });

    Route::group(array('prefix' => 'pedidos'), function(){
        Route::get('/', [PedidoController::class,'index'])->name('pedidos');
        Route::get('/cadastro/{pedido?}', [PedidoController::class,'verPedido'])->name('verPedido');
        Route::post('/excluir', [PedidoController::class,'excluir'])->name('excluir');
        //add salvar pedido
        Route::post('/salvar', [PedidoController::class,'salvarPedido'])->name('salvar-pedido');
        Route::get('/pagseguro/{pedido}',[PagSeguroController::class,'pagseguro']);
    });

    Route::group(array('prefix' => 'modalidades'), function(){
        Route::get('/list', [ModalidadeController::class,'listAllModalidades'])->name('lista-modalidade');
    });

    Route::group(array('prefix' => 'tamanhos'), function(){
        Route::get('/listaporproduto/{produto}', [TamanhoController::class,'listPorProduto'])->name('lista-tamanho-produto');
    });
});


