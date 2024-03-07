<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'onda_id' => 'required|exists:ondas,id',
            'notaParcial1' => 'required|numeric|min:0|max:10',
            'notaParcial2' => 'required|numeric|min:0|max:10',
            'notaParcial3' => 'required|numeric|min:0|max:10',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute precisa ser um número.',
            'min' => 'O campo :attribute precisa ser no mínimo 1.',
            'max' => 'O campo :attribute precisa ser no máximo até 10.',
            'exists' => 'O campo :attribute precisa ser um id válido.',
        ];
    }
}
