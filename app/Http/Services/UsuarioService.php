<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsuarioService {

    private function trataPassword($userData,$user)
    {
        if ($userData['password']) {
            return Hash::make($userData['password']);
        } else {
            return Hash::make($user->password);
        }
    }
    public function salvaUser(array $userData) : array
    {
        try {
            if (isset($userData['id']) && ($userData['id'])) {
                $user = User::find($userData['id']);
            } else {
                $user = new User();
            }
         
            $user->fill($userData);

            $user->password = $this->trataPassword($userData,$user);

            $user->save();
                                       
            if ($user){
                return ["success" => true, "result" => $user,"message" => "Usuário salvo com sucesso"];
            }
            return ["success" => false, "message" => "Não foi possível cadastrar o usuário."];
           
        } catch (Exception $e) {
            return ["success" => false, "message" => "Erro ao tentar cadastrar o Usuário. " . $e->getMessage()];
        }
    }

    public function getAllUsuarios(){
        $usuarios = User::orderby('nome')->get();

        $usuarios = $usuarios->map(function($usuario) {
            $usuario->tipo_usuario = $this->userTipoIdParaDescricao($usuario->tipo_usuario);
            return $usuario;
        });
        
        return $usuarios;
    }

    public function userTipoIdParaDescricao($tipo) {
        return match ($tipo) {
            1 => 'Admin',
            2 => 'Funcionário',
            3 => 'Coordenador',
            4 => 'Aluno'
        };
    }

    public function excluiUsuario(User $user){
        try {
            $user->delete();
            return [
                "success" => true,
                "result" => null,"message" => "Usuário excluido com sucesso"
            ];
        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => "Erro ao tentar excluir o Usuário. " . $e->getMessage()
            ];
        }
    }
}
