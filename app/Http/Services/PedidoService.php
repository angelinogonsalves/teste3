<?php

namespace App\Http\Services;

use App\Models\Pedido;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

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
            foreach($pedido->itens as $i){
                $i->delete();
            }
        }   
    }

    public function excluirPedido(Pedido $pedido){
        try {
            $this->excluirItensPedido($pedido);
            $pedido->delete();             
            return ["success" => true, "result" => null,"message" => "Pedido excluida com sucesso"];                  
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar excluir o Pedido. " . $e->getMessage()];                      
        }        
    }

    public function alterarStatusPedido(Pedido $pedido){
        if(!$pedido->podeMudarStatus()) {
            return ["success" => false, "message" => "Erro ao tentar alterar o status do pedido. "]; 
        }
        try {
            $pedido->status = $pedido->novoStatus();
            $pedido->save();  
            return ["success" => true, "result" => null,"message" => "Pedido alterado com sucesso"];                  
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar alterar o status do pedido. " . $e->getMessage()];                      
        }        
    }

    public function getPedidosPorRa($ra){
        return Pedido::where('ra_aluno',$ra)->get();
    }

    public function getAllPedidos(){
        if (auth()->user()->tipo_usuario ==3) {
            return Pedido::join('unidades', 'unidades.id', 'pedidos.unidade_id')
                        ->where('unidades.grupo_id', auth()->user()->grupo_id)
                        ->orderBy('pedidos.id', 'desc')->get();
        }

        return Pedido::orderby('id','desc')->get();            
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
        if (auth()->user()->tipo_usuario ==3) {
            return Pedido::join('unidades', 'unidades.id', 'pedidos.unidade_id')
                        ->where('unidades.grupo_id', auth()->user()->grupo_id)
                        ->orderBy('pedidos.id', 'desc')->take($qtde)->get();
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
