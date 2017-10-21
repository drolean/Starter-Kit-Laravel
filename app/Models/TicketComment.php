<?php

namespace App\Models;

use App\Traits\Empresa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketComment extends Model
{
    use SoftDeletes, Empresa;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets_comment';

    /**
     * Query the user that belongs to the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Query the ticket that belongs to the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comentario', 'user_id', 'ticket_id'];
}
