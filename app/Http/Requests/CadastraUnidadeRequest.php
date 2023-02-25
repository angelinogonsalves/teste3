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
            'razao_social' => 'required|max:100',
            'nome_fantasia' => 'nullable|max:100',
            'cnpj' => 'nullable|integer|max:15',                        
            'telefone' => 'nullable|integer|max:15',                                                
            'endereco' => 'nullable|max:150',                                                
            'numero' => 'nullable|max:10',                                                
            'bairro' => 'nullable|max:100',                                                
            'cep' => 'nullable|integer|max:8',                                                
            'cidade' => 'nullable|max:100',                                                
            'uf' => 'nullable|max:2'
        ];
    }
}
