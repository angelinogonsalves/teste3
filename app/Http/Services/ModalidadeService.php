<?php

namespace App\Http\Services;

use App\Models\Modalidade;

class ModalidadeService {
    public function getAllModalidades(){
        return Modalidade::orderby('modalidade')->get();            
    }
}