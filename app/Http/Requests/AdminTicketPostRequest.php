<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminTicketPostRequest extends FormRequest
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
        return [
            'titulo'     => 'required',
            'descricao'  => 'required',
            'tipo'       => 'required',
            'prioridade' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titulo.required'     => 'O campo título deve ser preenchido.',
            'descricao.required'  => 'O campo descrição deve ser preenchido.',
            'tipo.required'       => 'Você precisa especificar o tipo.',
            'prioridade.required' => 'Você precisa especificar a prioridade.',
        ];
    }
}
