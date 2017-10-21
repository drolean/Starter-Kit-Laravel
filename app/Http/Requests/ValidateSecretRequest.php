<?php

namespace App\Http\Requests;

use Cache;
use Crypt;
use App\User;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidatonFactory;

class ValidateSecretRequest extends FormRequest
{
    /**
     * @var \App\User
     */
    private $user;

    /**
     * Create a new FormRequest instance.
     *
     * @param \Illuminate\Validation\Factory $factory
     */
    public function __construct(ValidatonFactory $factory)
    {
        $factory->extend(
            'valid_token',
            function ($attribute, $value) {
                $secret = Crypt::decrypt($this->user->google2fa_secret);

                return Google2FA::verifyKey($secret, $value);
            },
            'Token inválido'
        );

        $factory->extend(
            'used_token',
            function ($attribute, $value) {
                $key = $this->user->id.':'.$value;

                return ! Cache::has($key);
            },
            'Token em uso'
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $this->user = User::findOrFail(
                session('2fa:user:id')
            );

            if (! $this->user->google2fa_secret) {
                return false;
            }
        } catch (\Exception $exc) {
            return false;
        }

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
            'totp' => 'bail|required|digits:6|valid_token|used_token',
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
            'totp.required' => 'Você precisa entrar com um token para prosseguir.',
            'totp.digits'   => 'O token deve contem 6 digitos.',
        ];
    }
}
