<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraUnidadeRequest;
use App\Http\Services\UnidadeService;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    protected $redirectTo = false;

    public $unidadeService;

    public function __construct()
    {
        $this->unidadeService = new UnidadeService();
    }

    public function index()
    {
        return view('unidade.lista-unidade');
    }

    public function editUnidade()
    {
        return view('unidade.nova-unidade');
    }

    public function salvaUnidade(CadastraUnidadeRequest $request){
    
        $validatedUnidade = $request->validated();

        $returnClient = $this->unidadeService->cadastraUnidade($validatedUnidade);    

        return back()->with('success', 'Unidade salva com sucesso.');
    }
}
