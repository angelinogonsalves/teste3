<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraProdutoRequest;
use App\Http\Services\ProdutoService;
use App\Http\Services\TamanhoService;
use App\Http\Services\UnidadeService;
use App\Models\Produto;
use App\Models\Tamanho;
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
        $tamanhoService = new TamanhoService();
        $lista_tamanhos = $tamanhoService->getAllTamanhos();   

        $unidadeService = new UnidadeService();
        $lista_unidades = $unidadeService->getAllUnidades();    

        $tamanhos_selecionados = [];
        if ($produto->tamanhos){
            $tamanhos_selecionados = $produto->tamanhos->map(function ($t){                
                return $t->tamanho_id;
            });
            $tamanhos_selecionados = $tamanhos_selecionados->toArray();
        }

        $unidades_selecionadas = [];
        if ($produto->unidades){
            $unidades_selecionadas = $produto->unidades->map(function ($u){                
                return $u->unidade_id;
            });
            $unidades_selecionadas = $unidades_selecionadas->toArray();
        }

        return view('produto.novo-produto',['dados' => $produto,'tamanhos_selecionados' =>$tamanhos_selecionados, 'lista_tamanhos' => $lista_tamanhos,'unidades_selecionadas' => $unidades_selecionadas, 'lista_unidades' => $lista_unidades]);
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
