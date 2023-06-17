<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    public function index(Request $request) {
        $filters = $request->all();
        $pedidos = Pedido::select('unidades.nome_fantasia', 'pedidos.id', 'pedidos.nome_aluno', 'pedidos.ra_aluno', 'pedidos.status', 'pedidos.created_at')
                        ->join('unidades', 'unidades.id', 'pedidos.unidade_id')
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
