<?php

namespace App\Http\Services;

use App\Models\Produto;
use App\Models\ProdutosTamanhos;

class ProdutoTamanhoService {

    public function AtualizaProdutosTamanhos(Produto $produto, array $tamanhos) {
        ProdutosTamanhos::where('produto_id', $produto->id)->delete();

        if ($tamanhos){
            foreach($tamanhos as $t){  
                ProdutosTamanhos::create(['produto_id' => $produto->id,'tamanho_id'=>$t]);
            }
        }
        
    }
}
