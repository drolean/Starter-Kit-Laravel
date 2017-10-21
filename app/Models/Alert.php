<?php

namespace App\Models;

use App\Traits\Empresa;
use App\Traits\Auditando;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use SoftDeletes, Auditando, Empresa;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'button_text', 'button_link', 'start_at', 'end_at'];
}
