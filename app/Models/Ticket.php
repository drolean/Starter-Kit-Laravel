<?php

namespace App\Models;

use Auth;
use App\Traits\Empresa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes, Empresa;

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
    protected $fillable = ['titulo', 'descricao', 'tipo', 'prioridade', 'user_id'];

    /**
     * Bootstrap application service.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('userid', function (Builder $builder) {
            // Mostra somente as fichas do seu usuario
            if (! auth()->user()->is_admin) {
                $builder->where('user_id', auth()->user()->id);
            }
        });
    }

    /**
     * Query the user that belongs to the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Query the comment that belongs to the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function Comment()
    {
        return $this->hasMany(TicketComment::class)->with('user');
    }
}
