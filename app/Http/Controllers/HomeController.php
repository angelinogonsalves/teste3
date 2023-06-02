<?php

namespace App\Http\Controllers;

use App\Http\Services\AlunoService;
use App\Http\Services\PagseguroService;
use App\Http\Services\PedidoService;

class HomeController extends Controller
{

    public function index()
    {                
        $pedidoService = new PedidoService();
        $pedidos = $pedidoService->getUltimosPedidos(5);   
        
        $pagseguroService = new PagseguroService();
        foreach($pedidos as $pedido) {
            if($pedido->podePagar()) {
                $pagseguroService->consultaPedido($pedido);
            }
        }

        $qtde_pedidos = $pedidoService->getQtdePedidos();               

        $qtde_pedidos_pagos = $pedidoService->getQtdePedidos(3);  
        $qtde_pedidos_pendentes = $pedidoService->getQtdePedidos(1);                            
        $qtde_pedidos_producao = $pedidoService->getQtdePedidos(4);  
        

        if (auth()->user()->tipo_usuario == 4){        
            return view('aluno.aluno-home',['pedidos' => $pedidos]);
        
        }else{      
            $alunoService = new AlunoService();
            $qtde_alunos = $alunoService->getQtdeAlunos();
            
            return view('home',['pedidos' => $pedidos,'qtde_alunos' => $qtde_alunos,'qtde_pedidos' => $qtde_pedidos,
            'qtde_pedidos_pagos' => $qtde_pedidos_pagos,'qtde_pedidos_pendentes' => $qtde_pedidos_pendentes, 'qtde_pedidos_producao' => $qtde_pedidos_producao]);
        
        }         
      
      
    }
}