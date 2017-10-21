<?php

namespace App\Models;

use App\Traits\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Activity extends Model
{
    use Empresa;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'content_type', 'content_id', 'acao', 'descricao', 'detalhes', 'ip_address', 'user_agent'];

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
     * Create an activity log entry.
     *
     * @param mixed $data
     *
     * @return bool
     */
    public static function log($data = [])
    {
        // set additional data and encode it as JSON if it is an array or an object
        if (isset($data['detalhes']) && (is_array($data['detalhes']) || is_object($data['detalhes']))) {
            $data['detalhes'] = json_encode($data['detalhes']);
        }

        // set the user ID
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;
        // set IP ip_address
        $data['ip_address'] = Request::getClientIp();
        // set user agent
        $data['user_agent'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No User Agent';

        // create the record
        static::firstOrCreate($data);

        return true;
    }

    /**
     * Set the Descricao.
     *
     * @param string $value
     *
     * @return void
     */
    public function setDescricaoAttribute($value)
    {
        $this->attributes['descricao'] = substr($value, 0, 255);
    }

    /**
     * Returns a Formated activity
     *
     * @return string
     */
    public function getActiviyAttribute()
    {
        switch ($this->acao) {
            case 'created':
                echo "Criou novo ";
                break;
            case 'updated':
                echo "Atualizou ";
                break;
            case 'deleted':
                echo "Apagou ";
                break;
        }

        switch ($this->content_type) {
            case 'App\User':
                echo "Usuário";
                break;
            case 'App\Models\Profile':
                echo "Perfil";
                break;
        }

        echo " (id: $this->content_id)";
    }    
}
