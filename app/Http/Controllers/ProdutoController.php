<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraProdutoRequest;
use App\Http\Services\ProdutoService;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends BaseController
{
    protected $redirectTo = false;

    public $produtoService;

    public function __construct()
    {
        $this->produtoService = new ProdutoService();
    }

    public function index()
    {
        $produtos = $this->produtoService->getAllProdutos();   
        
        $produtos = $produtos->map(function($produtos) {
            $produtos->valor = $this->formatMoneyBR($produtos->valor,true);
            return $produtos;
        });

        return view('produto.lista-produto',['dados' => $produtos]);
    }

    public function verProduto(Produto $produto)
    {
        return view('produto.novo-produto',['dados' => $produto]);
    }

    public function salvarProduto(CadastraProdutoRequest $request)
    {
        $validatedProduto = $request->validated();

        $returnProduto = $this->produtoService->salvaProduto($validatedProduto);    

        return $this->responseData($returnProduto,'/produtos/cadastro');     
    }

    public function detalhes()
    {
        return view('produto.detalhes-produto');
    }
}
