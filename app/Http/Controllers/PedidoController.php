<?php

namespace App\Http\Controllers;

use App\Http\Services\UnidadeService;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedido.lista-pedido');
    }

    public function verPedido(Pedido $pedido)
    {
        $unidadeService = new UnidadeService();
        $lista_unidades = $unidadeService->getAllUnidades();
        
        return view('pedido.novo-pedido',['dados' => $pedido,'lista_unidades' => $lista_unidades]);
    }
}
