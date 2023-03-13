<?php

namespace App\Http\Controllers;

use App\Http\Services\AlunoService;
use App\Http\Services\PedidoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
  //      $this->middleware('auth');
    }

    public function index()
    {
      
      if (auth()->user()->tipo_usuario == 4){
        
        return redirect('/aluno/home');
      
      }else{
        
        $pedidoService = new PedidoService();
        $pedidos = $pedidoService->getUltimosPedidos(5);      

        $alunoService = new AlunoService();
        $qtde_alunos = $alunoService->getQtdeAlunos();
        
        return view('home',['pedidos' => $pedidos,'qtde_alunos' => $qtde_alunos]);
      
      }         
      
      
    }
}
