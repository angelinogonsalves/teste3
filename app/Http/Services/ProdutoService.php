<?php

namespace App\Http\Services;

use App\Models\Produto;
use Exception;

class ProdutoService {
    public function salvaProduto(array $produtoData) : array
    {        
        try {   
            if ($produtoData['id']){
                $produto = Produto::find($produtoData['id']);
            } else {
                $produto = new Produto();
            }

            $produto->fill($produtoData);
            $produto->save();
                                       
            if ($produto){
                return ["success" => true, "result" => $produto,"message" => "Produto salvo com sucesso"];     
            }     
            return ["success" => false, "message" => "Não foi possível salvar o produto."];              
           
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar salvar o Produto. " . $e->getMessage()];      
        }               
    }

    public function getAllProdutos(){       
        return Produto::orderby('produto')->get();                            
    }

    public function excluiProduto(Produto $produto){
        try {
            $produto->delete();              
            return ["success" => true, "result" => null,"message" => "Produto excluido com sucesso"];                  
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar excluir o Produto. " . $e->getMessage()];                      
        }
    }
}
