<?php

namespace App\Models;

use Funcoes;
use Carbon\Carbon;
use App\Traits\Auditando;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Auditando;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cnpj_cpf', 'rg', 'endereco', 'bairro', 'cidade', 'estado', 'cep', 'telefone', 'celular', 'bio',
        'aniversario', 'avatar', 'numero', 'complemento', 'sexo',
    ];

    /**
     * Query the user that belongs to the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Seta atributo.
     *
     * @param string $value
     *
     * @return void
     */
    public function setAniversarioAttribute($value)
    {
        $this->attributes['aniversario'] = (Funcoes::validateDate($value, 'd/m/Y')) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    /**
     * Pega Valor.
     *
     * @param string $value
     *
     * @return string
     */
    public function getAniversarioAttribute($value)
    {
        return ! is_null($value) ? Carbon::parse($value)->format('d/m/Y') : null;
    }
}
