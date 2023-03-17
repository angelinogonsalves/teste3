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

        return view('produto.novo-produto',['dados' => $produto,'lista_tamanhos' => $lista_tamanhos,'lista_unidades' => $lista_unidades]);
    }
   
    public function salvarProduto(CadastraProdutoRequest $request)    
    {
        //  File Upload
        if($request->hasFile('imagem1')){
            $filenameWithExt = $request->file('imagem1')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('imagem1')->getClientOriginalExtension();
            // Filename to store
            $nomeImagem = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $request->file('imagem1')->storeAs('public/produtos', $nomeImagem);
        }       
        if($request->hasFile('imgmedidas')){
            $filenameWithExtMed = $request->file('imgmedidas')->getClientOriginalName();
            // Get just filename
            $filenameMed = pathinfo($filenameWithExtMed, PATHINFO_FILENAME);
            // Get just ext
            $extensionMed = $request->file('imgmedidas')->getClientOriginalExtension();
            // Filename to store
            $nomeImagemMedidas = $filenameMed.'_'.time().'.'.$extension;
            // Upload Image
            $request->file('imgmedidas')->storeAs('public/produtos', $nomeImagemMedidas);
        } else {
            $nomeImagemMedidas = 'noimagemedidas.png';
        }
        $validatedProduto = $request->validated();
        //dd($validatedProduto);
        $returnProduto = $this->produtoService->salvaProduto($validatedProduto, $nomeImagem, $nomeImagemMedidas); 
        //dd($returnProduto);
        return $this->responseData($returnProduto,'/produtos/cadastro');     
    }

    public function detalhes()
    {
        return view('produto.detalhes-produto');
    }

    public function excluirProduto(Produto $produto){              

        $returnUnidade = $this->produtoService->excluiProduto($produto);    

        return $this->responseData($returnUnidade,'produtos');                   
    }

    public function listaPorUnidade(Unidade $unidade) {
        return $this->produtoService->getProdutosPorUnidade($unidade);        
    }
}
