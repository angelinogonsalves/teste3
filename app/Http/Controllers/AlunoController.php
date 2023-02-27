<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function inicio()
    {
        return view('aluno.aluno-home');
    }
    public function detalhesPedido()
    {
        return view('aluno.aluno-detalhes-pedido');
    }
}
