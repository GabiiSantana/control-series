<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest {

    // Define se a requisição está autorizada
    public function authorize(): bool {
        return true;
    }

    // Regras de validação do formulário
    public function rules(): array {
        return [
            'name' => ['required', 'min:3'],
        ];
    }

    // Mensagens personalizadas de erro
    public function messages() {
        return [
            'name.required' => 'O campo está vazio.',
            'name.min' => 'O título precisa ter pelo menos :min caracteres'
        ];
    }
}