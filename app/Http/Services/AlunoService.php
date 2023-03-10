<?php

namespace App\Http\Services;

use App\Models\User;

class AlunoService {

    public function getAllAlunos(){
        return User::where('tipo_usuario','4')->orderby('nome')->get();  
    }

    public function getQtdeAlunos(){
        return User::where('tipo_usuario','4')->count();  
    }
}
