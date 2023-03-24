<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

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
         $pedido->itens->map(function($produto) {   
            $url =  url('/img/perfil.jpg');

            if ($produto->produto->imagens){            
                $url = url('/img/produtos')  . '/' . $produto->produto->imagens[0]->imagem;
            }
            return $produto->url = $url;
                     
        }); 
        return view('aluno.aluno-detalhes-pedido',['pedido' => $pedido]);
    }
}
