<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        return view('unidade.lista-unidade');
    }

    public function editUnidade()
    {
        return view('unidade.nova-unidade');
    }
}
