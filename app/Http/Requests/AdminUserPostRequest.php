<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'     => 'required|string|max:255',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
                ];
            case 'PATCH':
                return [
                    'name' => 'required|string|max:255',
                ];
            case 'PUT':
                return [
                ];
            default:
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'      => 'O campo nome deve ser preenchido.',
            'email.required'     => 'O campo email deve ser preenchido.',
            'email.email'        => 'Email parece não ser válido.',
            'email.unique'       => 'Já existe um usuário com esse email.',
            'password.required'  => 'O campo senha deve ser preenchido.',
            'password.confirmed' => 'Senhas não conferem.',
        ];
    }
}
