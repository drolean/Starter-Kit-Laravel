<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_socials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
