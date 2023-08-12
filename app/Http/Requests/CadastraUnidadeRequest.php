<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastraUnidadeRequest extends FormRequest
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
            'razao_social' => 'string|required|max:100',
            'nome_fantasia' => 'string|required|max:100',
            'email' => 'string|nullable|max:100',
            'cnpj' => 'string|nullable|digits:14',                        
            'telefone' => 'integer|nullable|digits_between:10,12',                                                
            'endereco' => 'string|nullable|max:150',                                                
            'numero' => 'string|nullable|max:10',                                                
            'bairro' => 'string|nullable|max:100',                                                
            'cep' => 'string|nullable|max:8',                                                
            'cidade' => 'string|nullable|max:100',                                                
            'uf' => 'string|nullable|max:2',
            'grupo_id' => 'integer|required'
        ];
    }
}
