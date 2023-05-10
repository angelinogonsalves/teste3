<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraProdutoRequest;
use App\Http\Services\ProdutoService;
use App\Http\Services\TamanhoService;
use App\Http\Services\UnidadeService;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\Unidade;
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
                   
        $imagens = $produto->imagens->map(function($imagem) {
            $imagem->url =  url('/img/produtos') . '/' .$imagem->imagem;
            return $imagem;
        });

        return view('produto.novo-produto',['dados' => $produto,'lista_tamanhos' => $lista_tamanhos,'lista_unidades' => $lista_unidades]);
    }
   
    public function salvarProduto(CadastraProdutoRequest $request)    
    {
        $validatedProduto = $request->validated();
        $returnProduto = $this->produtoService->salvaProduto($validatedProduto); 
        return $this->responseData($returnProduto,'/produtos/cadastro');     
    }

    public function detalhes(Produto $produto)        
    {        
      
        $produto->imagens->map(function($imagem) {
            $imagem->url =  url('/img/produtos') . '/' .$imagem->imagem;
            return $imagem;
        });        
       
        return view('produto.detalhes-produto',['dados' => $produto]);
    }

    public function excluirProduto(Produto $produto){              

        $returnUnidade = $this->produtoService->excluiProduto($produto);    

        return $this->responseData($returnUnidade,'produtos');                   
    }

    public function listaPorUnidade(Unidade $unidade) {
        $produtos = $this->produtoService->getProdutosPorUnidade($unidade);

        $produtos->map(function($produto) {   
            $url =  url('/img/perfil.jpg');
            if (count($produto->imagens) > 0){  
                $url = url('/img/produtos')  . '/' . $produto->imagens[0]->imagem;
            }
            return $produto->url = $url;
                     
        });     

        return $produtos;
    }
}
