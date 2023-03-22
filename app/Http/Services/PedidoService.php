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
                $pedidoData['status'] = 1; // pedido realizado começa em 1
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
                
                $this->atualizaUsuarioPedido($pedido);
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

    public function getPedidosPorRa($ra){
        return Pedido::where('ra_aluno',$ra)->get();
    }

    public function getAllPedidos(){
        return Pedido::get();            
    }

    public function getQtdePedidos($status = null)
    {
        if ($status){
            return Pedido::where('status',$status)->count();
        } 
        return Pedido::count();
        
    }
  

    public function getUltimosPedidos($qtde){
        if (auth()->user()->tipo_usuario ==4) {
            return Pedido::where('user_id',auth()->user()->id)->orderBy('id', 'desc')->take($qtde)->get();        
        }

        return Pedido::orderBy('id', 'desc')->take($qtde)->get();        
    }    

    public function atualizaUsuarioPedido(Pedido $pedido){       
        if (!$pedido->user_id) {
            $userService = new UsuarioService();

            $usuario = $userService->getUsuarioporRA($pedido->ra_aluno);
            
            if (!empty($usuario->id)) {
                $pedido->user_id = $usuario->id;
            }

            $pedido->save();
        }        
    }
}
