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
        return view('aluno.aluno-detalhes-pedido',['pedido' => $pedido]);
    }
}
