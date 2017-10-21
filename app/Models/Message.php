<?php

namespace App\Models;

use App\Traits\Empresa;
use App\Traits\Auditando;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Auditando, Empresa;

    /**
     * Fields that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['company_id', 'updated_at', 'user_id', 'id'];

    /**
     * A message belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
