<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraUnidadeRequest;
use App\Http\Services\GrupoService;
use App\Http\Services\UnidadeService;
use App\Models\Unidade;

class UnidadeController extends BaseController
{
    protected $redirectTo = false;

    public $unidadeService;

    public function __construct()
    {
        $this->unidadeService = new UnidadeService();
    }

    public function index()
    {
        $unidades =  $this->unidadeService->getAllUnidades();       
        return view('unidade.lista-unidade',['dados' => $unidades]);
    }

    public function verUnidade(Unidade $unidade)
    {      
        $grupoService = new GrupoService();
        $grupos = $grupoService->getAllGrupos();

        return view('unidade.nova-unidade',['dados' => $unidade, 'grupos' => $grupos]);
    }

    public function excluirUnidade(Unidade $unidade){              

        $returnUnidade = $this->unidadeService->excluiUnidade($unidade);    

        return $this->responseData($returnUnidade,'unidades');                   
    }

    public function salvaUnidade(CadastraUnidadeRequest $request){    
    
        $validatedUnidade = $request->validated();

        $returnUnidade = $this->unidadeService->salvaUnidade($validatedUnidade);    

        return $this->responseData($returnUnidade,'/unidades/cadastro');                   
    }
}
