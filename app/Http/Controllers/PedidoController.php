<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedido.lista-pedido');
    }

    public function editPedido()
    {
        return view('pedido.novo-pedido');
    }
}
