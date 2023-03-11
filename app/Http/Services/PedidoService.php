<?php

namespace App\Http\Services;

use App\Models\Pedido;
use Exception;

class PedidoService {
    public function salvaPedido(array $pedidoData) : array
    {        
        try {   
            if ($pedidoData['id']){
                $pedido = Pedido::find($pedidoData['id']);                
            } else {             
                $pedido = new Pedido();
                $pedidoData['status'] = 0;
                $pedidoData['valor'] = 0;
            }            

            $produtos = $pedidoData['produtos'];
            unset($pedidoData['produtos']);        
            unset($pedidoData['id']);          
            $pedido->fill($pedidoData);
            $pedido->save();

            $total = $this->salvaItensPedido($pedido,$produtos);

            if($total > 0) {  
                $pedido->valor = $total;
                $pedido->save();                                                  
                return ["success" => true, "result" => $pedido,"message" => "Pedido salvo com sucesso"];                     
            }
            return ["success" => false, "message" => "Não foi possível cadastrar o Pedido."];              
           
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar cadastrar o Pedido. " . $e->getMessage()];      
        }               
    }

    private function salvaItensPedido(Pedido $pedido, $itensData){
        $total = 0;
        try {  
            $this->excluirItensPedido($pedido);
         
            $produtoService = new ProdutoService();
            
            foreach($itensData as $i){
                $produto = $produtoService->getProdutoDataById($i['produto_id']);
                $i['valor_unitario'] = $produto->valor;
                $total += round($produto->valor * $i['quantidade'],2);
                $pedido->itens()->create(
                    $i
                );
            }
            return $total;
        } catch (Exception $e) {    
            return 0;      
        } 
               
    }

    private function excluirItensPedido(Pedido $pedido){
        if ($pedido->itens){
            foreach($pedido->itens() as $i){
                $i->delete();
            }
        }   
    }

    public function getAllPedidos(){
        return Pedido::get();            
    }

    public function getUltimosPedidos($qtde){
        return Pedido::orderBy('id', 'desc')->take($qtde)->get();        
    }    
}
