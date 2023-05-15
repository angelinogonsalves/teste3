<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nome' => 'required|max:100',
            'ra' => "required|unique:users,ra,null,id,unidade_id,{$this->input('unidade_id')}",          
            'unidade_id' => 'integer|required',                      
            'email' => 'email|required|max:100|unique:users',                                 
            'password' => 'required|confirmed|max:100'             
            // 'ddd' => 'required|digits:2',       
            // 'telefone' => 'required|digits_between:8,9',                                                
            // 'cpf' => 'string|required|digits:11'
        ];
    }
}
