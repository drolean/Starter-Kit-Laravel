<?php

namespace App\Models;

use App\Traits\Empresa;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Empresa;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the list of users related to the current Role.
     *
     * @return array permissions
     */
    public function getPermissionsListAttribute()
    {
        return array_map('intval', $this->permissions->pluck('id')->toArray());
    }

    /**
     * A role may be given users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the list of users related to the current Role.
     *
     * @return array permissions
     */
    public function getUsersListAttribute()
    {
        return $this->users->pluck('id');
    }
}
