<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/loga', [AuthController::class,'loga'])->name('loga');
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::post('/registra', [AuthController::class,'registra'])->name('registra');
Route::get('/recuperar-senha', [AuthController::class,'recuperarSenha'])->name('recuperar-senha');

Route::middleware(['auth'])->group(function () {
      
    Route::get('/', [HomeController::class,'index'])->name('home');

    Route::get('home/', [HomeController::class,'index'])->name('home');

    Route::group(array('prefix' => 'usuarios'), function(){
        Route::get('/', [UserController::class,'index'])->name('usuarios');
        Route::get('/cadastro/{user?}', [UserController::class,'verUsuario'])->name('ver-usuario');
        Route::post('/excluir/{user}', [UserController::class,'excluirUsuario'])->name('excluir-usuario');
        Route::post('/salvar', [UserController::class,'salvaUsuario'])->name('salvar-usuario');
    });

});