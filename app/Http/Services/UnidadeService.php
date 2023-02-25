<?php

namespace App\Http\Services;

use App\Models\Unidade;
use Exception;

class UnidadeService {
    public function cadastraUnidade(array $unidadeData) : array
    {
        try {           
            $newUnidade= Unidade::create($unidadeData);
            if ($newUnidade){
                return ["success" => true, "result" => $newUnidade,"message" => "Unidade cadastrada com sucesso"];     
            }     
            return ["success" => false, "message" => "Não foi possível cadastrar a unidade."];              
           
        } catch (Exception $e) {    
            return ["success" => false, "message" => "Erro ao tentar cadastrar a Unidade. " . $e->getMessage()];      
        }               
    }
}
