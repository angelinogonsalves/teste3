<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraUnidadeRequest;
use App\Http\Services\TamanhoService;
use App\Http\Services\UnidadeService;
use App\Models\Produto;
use App\Models\Unidade;

class TamanhoController extends BaseController
{
    protected $redirectTo = false;

    public $tamanhoService;

    public function __construct()
    {
        $this->tamanhoService = new TamanhoService();
    }

    public function listPorProduto(Produto $produto){    
        return $this->tamanhoService->listPorProduto($produto);
    }
}
