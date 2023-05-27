<?php

namespace App\Http\Controllers;

use App\Http\Services\PagseguroService;
use App\Http\Services\ProdutoService;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Unidade;

//use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function inicio()
    {
   //     return view('aluno.aluno-home');
    }
    public function detalhesPedido(Pedido $pedido)
    {
        if (auth()->user()->tipo_usuario == 4){
            if ($pedido->user_id != auth()->user()->id){
                return redirect('/');
            }
        }
             
        $pagseguroService = new PagseguroService();
        // $pedido->url_qr_code = $pagseguroService->geraURLQrCode($pedido);0
        
        $pedido->itens->map(function($produto) {   
            $url =  url('/img/perfil.jpg');

            if ($produto->produto->imagens){            
                $url = url('/img/produtos')  . '/' . $produto->produto->imagens[0]->imagem;
            }
            return $produto->url = $url;
                     
        }); 
        
        return view('aluno.aluno-detalhes-pedido',['pedido' => $pedido]);
    }

    public function novoPedido(Pedido $pedido)
    {
        $produtos = Produto::with('tamanhos')
                    ->whereHas('unidades', function ($query) {
                        $query->where('unidade_id', auth()->user()->unidade_id);
                    })
                    ->where('disponibilidade', 'aluno')
                    ->orderBy('produto')
                    ->get();

        $produtos->map(function($produto) {   
            $url =  url('/img/perfil.jpg');
            if (count($produto->imagens) > 0){  
                $url = url('/img/produtos')  . '/' . $produto->imagens[0]->imagem;
            }
            return $produto->url = $url;
                        
        });   

        $pedido->itens->map(function($produto) {   
            $url =  url('/img/perfil.jpg');

            if ($produto->produto->imagens){            
                $url = url('/img/produtos')  . '/' . $produto->produto->imagens[0]->imagem;
            }
            return $produto->url = $url;        
        });

        return view('aluno.aluno-novo-pedido',['dados' => $pedido, 'produtos' => $produtos]);
    }
}
