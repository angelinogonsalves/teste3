<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraGrupoRequest;
use App\Http\Services\GrupoService;
use App\Models\Grupo;

class GrupoController extends BaseController
{
    protected $redirectTo = false;

    public $grupoService;

    public function __construct()
    {
        $this->grupoService = new GrupoService();
    }

    public function index()
    {
        $grupos =  $this->grupoService->getAllGrupos();       
        return view('grupo.lista-grupo',['dados' => $grupos]);
    }

    public function verGrupo(Grupo $grupo)
    {                   
        return view('grupo.novo-grupo',['dados' => $grupo]);
    }

    public function excluirGrupo(Grupo $grupo){              

        $returnGrupo = $this->grupoService->excluiGrupo($grupo);    

        return $this->responseData($returnGrupo,'grupos');                   
    }

    public function salvaUnidade(CadastraGrupoRequest $request){    
    
        $validatedGrupo = $request->validated();

        $returnGrupo = $this->grupoService->salvaGrupo($validatedGrupo);    

        return $this->responseData($returnGrupo,'/grupos/cadastro');                   
    }
}
