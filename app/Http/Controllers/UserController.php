<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraUsuarioRequest;
use App\Http\Services\UnidadeService;
use App\Http\Services\UsuarioService;
use App\Models\User;

class UserController extends BaseController
{
    protected $redirectTo = false;

    public $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function index()
    {
        $usuarios =  $this->usuarioService->getAllUsuarios(); 
        return view('user.lista-user',['dados' => $usuarios]);
    }

    public function verUsuario(User $user)
    {                           
        $unidadeService = new UnidadeService(); 
        $unidades = $unidadeService->getAllUnidades();
        return view('user.novo-user',['dados' => $user,'unidades' => $unidades]);
    }

    public function excluirUsuario(User $user){              

        $returnUser = $this->usuarioService->excluiUsuario($user);    

        return $this->responseData($returnUser,'usuarios');                   
    }

    public function salvaUsuario(CadastraUsuarioRequest $request){    
    
        $validatedUsuario = $request->validated();

        $returnUsuario = $this->usuarioService->salvaUser($validatedUsuario);    

        return $this->responseData($returnUsuario,'/usuarios/cadastro');                   
    }
}
