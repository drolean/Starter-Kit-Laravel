<?php

namespace App\Http\Requests;

class AdminEmpresaPostRequest extends Request
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
                    'empresa'  => 'required',
                    'cnpj'     => 'required|unique:companies',
                    'telefone' => 'required',
                    'endereco' => 'required',
                    'name'     => 'required|max:255',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
                ];
            case 'PATCH':
                return [
                    'empresa'  => 'required',
                    'cnpj'     => 'required|unique:companies,cnpj,'.$this->cnpj.',cnpj',
                    'telefone' => 'required',
                    'endereco' => 'required',
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
            'empresa.required'   => 'Você deve preencher o nome da Empresa..',
            'cnpj.required'      => 'CNPJ precisa ser preenchido.',
            'cnpj.unique'        => 'Já existe uma empresa com esse CNPJ.',
            'telefone.required'  => 'O campo telefone deve ser preenchido.',
            'endereco.required'  => 'O campo endereço deve ser preenchido.',
            'name.required'      => 'O campo nome deve ser preenchido.',
            'email.required'     => 'O campo email deve ser preenchido.',
            'email.email'        => 'Email parece não ser válido.',
            'email.unique'       => 'Já existe um usuário com esse email.',
            'password.required'  => 'O campo senha deve ser preenchido.',
            'password.confirmed' => 'Senhas não conferem.',
        ];
    }
}
