<?php

namespace App\Models;

use App\Traits\Auditando;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companie extends Model
{
    use SoftDeletes, Auditando;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['empresa', 'cnpj', 'telefone', 'endereco', 'active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['active', 'max_users', 'user_id', 'deleted_at', 'created_at', 'updated_at', 'company_id'];

    /**
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    /**
     * Retorna todos os usuarios vinculados a empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function Usuarios()
    {
        return $this->belongsToMany('App\User', 'companie_user', 'companie_id', 'user_id');
    }

    /**
     * Retorna todos os usuarios vinculados a empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function UsersMany()
    {
        return $this->hasMany('App\User', 'company_id', 'id');
    }

    /**
     * Query the user that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns a LOGO URL for the companie.
     *
     * @return string
     */
    public function getLogoAttribute($value)
    {
        if ($value != 'default.jpg' && $value != null) {
            return '/images/'.$value;
        }

        return asset('/logo.png');
    }
}
