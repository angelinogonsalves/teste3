<?php

namespace App\Http\Services;

use App\Models\Produto;
use App\Models\ProdutoImagem;
use App\Models\ProdutosUnidades;

class ProdutoImagemService {

    public function AtualizaProdutosImagens(Produto $produto, array $array_produtos) {

        ProdutoImagem::where('produto_id', $produto->id)->delete();

        if (isset($array_produtos['foto_produto'])){
            foreach($array_produtos['foto_produto'] as $u){  
                ProdutoImagem::create(['produto_id' => $produto->id,'imagem'=>$u,'tipo' =>'P']);
            }
        }

        if (isset($array_produtos['foto_tamanho'])){            
            foreach($array_produtos['foto_tamanho'] as $u){  
                ProdutoImagem::create(['produto_id' => $produto->id,'imagem'=>$u,'tipo' =>'T']);
            }
        }
        
    }
}
