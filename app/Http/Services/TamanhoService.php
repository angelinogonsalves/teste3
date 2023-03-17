<?php

namespace App\Http\Services;

use App\Models\Produto;
use App\Models\Tamanho;
use Exception;

class TamanhoService {

    public function getAllTamanhos(){
        
        return Tamanho::orderby('id')->get();                    
        
    } 
    public function listPorProduto(Produto $produto){   

        return $produto->tamanhos()->get();                    
    } 
}
