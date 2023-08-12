<?php

namespace App\Http\Services;

use App\Models\Grupo;
use App\Models\User;
use Exception;

class GrupoService {
    public function salvaGrupo(array $grupoData) : array
    {        
        try {   
            if ($grupoData['id']){
                $grupo = Grupo::find($grupoData['id']);
            } else {
                $grupo = new Grupo();
            }

            $grupo->fill($grupoData);
            $grupo->save();
                                       
            if ($grupo){
                return ["success" => true, "result" => $grupo,"message" => "Grupo salvo com sucesso"];     
            }     
            return ["success" => false, "message" => "Não foi possível cadastrar o Grupo."];              
           
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar cadastrar o Grupo. " . $e->getMessage()];      
        }               
    }

    public function getAllGrupos(){
        
        if ((auth()->check()) && (auth()->user()->tipo_usuario >=4)) {
            return Grupo::where('grupo_id',auth()->user()->unidade_id)->orderby('nome')->get();  
        }   
        return Grupo::orderby('nome')->get();                    
        
    }

    public function getGrupoUsuario(User $user){
                 
    }

    public function excluiGrupo(Grupo $grupo){
        try {
            $grupo->delete();              
            return ["success" => true, "result" => null,"message" => "Grupo excluido com sucesso"];                  
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar excluir o Grupo. " . $e->getMessage()];                      
        }
    }
}
