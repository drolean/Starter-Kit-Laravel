<?php

namespace App;

use Cache;
use Carbon\Carbon;
use App\Models\Profile;
use App\Traits\Empresa;
use App\Traits\HasRoles;
use App\Traits\Auditando;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserConfirmationNotification;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Auditando, Empresa, HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation_code', 'password_change_at', 'is_admin', 'blocked_on', 'activation', 'avatar', 'company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin', 'password_change_at', 'is_super', 'blocked_on', 'activation_code', 'activation', 'created_at', 'updated_at',
        'company_id', 'google2fa_secret', 'last_login', 'last_login_ip',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login', 'password_change_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin'   => 'boolean',
        'is_super'   => 'boolean',
        'activation' => 'boolean',
    ];

    /**
     * Bootstrap application service.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($User) {
            $User->profile()->save(new Profile());
        });
    }

    /**
     * Return Online tag.
     *
     * @return tring
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Return a Profile for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function Profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Return a Collection Activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function Activity()
    {
        return $this->hasMany('App\Models\Activity');
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function Companie()
    {
        return $this->hasOne('App\Models\Companie', 'id', 'company_id');
    }

    /**
     * Processa empresas vinculadas ao usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function Empresas()
    {
        return $this->belongsToMany('App\Models\Companie', 'companie_user', 'user_id', 'companie_id');
    }

    /**
     * Get the list of users related to the current User.
     *
     * @return array roels
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Returns a Gravatar URL for the users email address.
     *
     * @return string
     */
    public function getGravatarAttribute()
    {
        if ($this->avatar) {
            return '/images/'.$this->avatar;
        }

        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "//www.gravatar.com/avatar/$hash";
    }

    /**
     * Seta atributo password com Bcrypt.
     *
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = $value;
        }
    }

    /**
     * Suspende usuario.
     *
     * @param bool $val True or False para suspender ou remover a suspensao
     *
     * @return bool Sempre returna true
     */
    public function suspender($val)
    {
        // suspende
        if ($val == 'true') {
            $this->update(['blocked_on' => Carbon::now()]);
        } else {
            $this->update(['blocked_on' => null]);
        }

        return true;
    }

    /**
     * Returns a Admin status based on companie.
     *
     * @return bool
     */
    public function getIsAdminAttribute($value)
    {
        if ($this->is_super == 1) {
            return true;
        }

        if ($value == 1) {
            return true;
        }

        return ((! isset($this->companie)) || $this->companie->user_id == $this->id) ? true : false;
    }

    /**
     * Processa quem pode ver minhas coisas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'users_link', 'link_id', 'user_id')->withTimestamps();
    }

    /**
     * Processa quem o usuario pode ver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(self::class, 'users_link', 'user_id', 'link_id')->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the user confirmation notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendUserConfirmationNotification($token)
    {
        $this->notify(new UserConfirmationNotification($token));
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetSuper($query)
    {
        return $query->where('is_super', 1)->get();
    }

    /**
     * Return a Collection Activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * A user can have many messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}
