<?php

namespace App\Http\Services;

use App\Models\Unidade;
use App\Models\User;
use Exception;

class UnidadeService {
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

    public function getAllUnidades(){
        
        if ((auth()->check()) && (auth()->user()->tipo_usuario >=4)) {
            return Unidade::where('unidade_id',auth()->user()->unidade_id)->orderby('nome_fantasia')->get();  
        }   
        return Unidade::orderby('nome_fantasia')->get();                    
        
    }

    public function getUnidadeUsuario(User $user){
                 
    }

    public function excluiUnidade(Unidade $unidade){
        try {
            $unidade->delete();              
            return ["success" => true, "result" => null,"message" => "Unidade excluida com sucesso"];                  
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar excluir a Unidade. " . $e->getMessage()];                      
        }
    }
}
