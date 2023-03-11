<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraPedidoRequest;
use App\Http\Services\ModalidadeService;
use App\Http\Services\PedidoService;
use App\Http\Services\UnidadeService;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public $pedidoService;

    public function __construct()
    {
        $this->pedidoService = new PedidoService();
    }

    public function index()
    {
        $pedidos = $this->pedidoService->getAllPedidos();
        return view('pedido.lista-pedido',['dados' =>  $pedidos]);
    }

    public function verPedido(Pedido $pedido)
    {
        $unidadeService = new UnidadeService();
        $lista_unidades = $unidadeService->getAllUnidades();

        $modalidadeService = new ModalidadeService();
        $lista_modalidades = $modalidadeService->getAllModalidades();
        
        return view('pedido.novo-pedido',['dados' => $pedido,'lista_unidades' => $lista_unidades,'lista_modalidades' => $lista_modalidades]);
    }
    
    // só para ver se está chegando
    public function salvarPedido(CadastraPedidoRequest $request)
    {        
        $validated_Pedido = $request->validated();    
        return $this->pedidoService->salvaPedido($validated_Pedido);        
    }
}
