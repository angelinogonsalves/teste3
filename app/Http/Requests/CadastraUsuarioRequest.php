<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastraUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {        
        return [
            'id' => 'nullable|integer',
            'nome' => 'required|max:100',
            'email' => 'required|max:100',            
            'password' => 'required_without:id|confirmed|max:100',                        
            'tipo_usuario' => 'required|max:4',                        
            'unidade_id' => 'integer|nullable',                        
            'telefone' => 'integer|nullable|digits_between:10,12',                                                
            'endereco' => 'string|nullable|max:150',                                                
            'numero' => 'string|nullable|max:10',                                                
            'bairro' => 'string|nullable|max:100',                                                
            'cep' => 'string|nullable|max:8',                                                
            'cidade' => 'string|nullable|max:100',                                                
            'uf' => 'string|nullable|max:2'
        ];
    }
}
