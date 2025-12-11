<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'  => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'cpf'   => ['required', 'digits:11', 'unique:users,cpf'],
            'profile_id' => ['required', 'integer', 'exists:profiles,id'],

            // addresses opcional
            'addresses'   => ['nullable', 'array'],
            'addresses.*' => ['integer', 'exists:addresses,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'cep.digits' => 'O CEP deve conter exatamente 8 números.',
            'cpf.digits' => 'O CPF deve conter exatamente 11 números.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
        ];
    }
}
