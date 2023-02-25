<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return view('produto.lista-produto');
    }

    public function editProduto()
    {
        return view('produto.novo-produto');
    }
}
