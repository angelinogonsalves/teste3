<?php

namespace App\Http\Controllers;

use App\Http\Services\UnidadeService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedido.lista-pedido');
    }

    public function editPedido()
    {
        $unidadeService = new UnidadeService();
        $unidades = $unidadeService->getAllUnidades();

        
        return view('pedido.novo-pedido',['unidades' => $unidades]);
    }
}
