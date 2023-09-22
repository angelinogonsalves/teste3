<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    public function index(Request $request) {
        $filters = $request->all();
        $pedidos = Pedido::select(  'pedido_itens.id AS numero_item', 
                                    'pedidos.id AS numero_pedido', 
                                    'unidades.nome_fantasia', 
                                    'produtos.produto', 
                                    'modalidades.modalidade', 
                                    'pedido_itens.nome_personalizado', 
                                    'pedidos.ra_aluno', 
                                    'pedidos.nome_aluno', 
                                    'pedido_itens.quantidade', 
                                    'tamanhos.tamanho', 
                                    'pedidos.status',
                                    'pedidos.created_at')
                        ->leftJoin('unidades', 'unidades.id', 'pedidos.unidade_id')
                        ->leftJoin('pedido_itens', 'pedido_itens.pedido_id', 'pedidos.id')
                        ->leftJoin('produtos', 'produtos.id', 'pedido_itens.produto_id')
                        ->leftJoin('tamanhos', 'tamanhos.id', 'pedido_itens.tamanho_id')
                        ->leftJoin('modalidades', 'modalidades.id', 'pedido_itens.modalidade_id')
                        ->where(function ($query) use ($filters) {
                            if (@$filters['inicio']) {
                                $query->where('pedidos.created_at', '>=', "{$filters['inicio']}"); 
                            }
                            if (@$filters['fim']) {
                                $query->where('pedidos.created_at', '<=', "{$filters['fim']} 23:59:00"); 
                            }
                            $query->whereNotNull('pedidos.id');
                        })
                        ->get();
        
        return view('relatorios.pedidos',['dados' => $pedidos, 'filtros' => $filters]);
    }


}
