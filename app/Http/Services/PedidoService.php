<?php

namespace App\Http\Services;

use App\Models\Pedido;
use Exception;

class PedidoService {
    public function salvaUnidade(array $unidadeData) : array
    {        
        try {   
            if ($unidadeData['id']){
                $unidade = Unidade::find($unidadeData['id']);
            } else {
                $unidade = new Unidade();
            }

            $unidade->fill($unidadeData);
            $unidade->save();
                                       
            if ($unidade){
                return ["success" => true, "result" => $unidade,"message" => "Unidade salva com sucesso"];     
            }     
            return ["success" => false, "message" => "Não foi possível cadastrar a unidade."];              
           
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar cadastrar a Unidade. " . $e->getMessage()];      
        }               
    }

    public function getAllPedidos(){
        return Pedido::get();            
    }

    public function getUltimosPedidos($qtde){
        return Pedido::orderBy('id', 'desc')->take($qtde)->get();        
    }    
}
