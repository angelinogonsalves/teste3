<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastraProdutoRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor' => str_replace(',','.',str_replace('.','',$this->input('valor')))
        ]);
    }

    public function rules(): array
    {        
        return [
            'id' => 'nullable|integer',
            'codigo' => 'required|max:50',
            'produto' => 'required|max:100',            
            'descricao' => 'nullable|max:500',                        
            'valor' => 'required|numeric',                                   
        ];
    }
}
