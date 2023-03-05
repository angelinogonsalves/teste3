<?php

namespace App\Http\Services;

use App\Models\Produto;
use App\Models\ProdutosUnidades;

class ProdutoUnidadeService {

    public function AtualizaProdutosUnidades(Produto $produto, array $unidades) {
        ProdutosUnidades::where('produto_id', $produto->id)->delete();

        if ($unidades){
            foreach($unidades as $u){  
                ProdutosUnidades::create(['produto_id' => $produto->id,'unidade_id'=>$u]);
            }
        }
        
    }
}
