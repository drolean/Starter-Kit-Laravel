<?php

namespace App\Traits;

use Auth;
use Hashids;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;

trait Empresa
{
    /**
     * @var string
     */
    private static $coluna = 'company_id';

    /**
     * @var string
     */
    private static $tabela = 'companies';

    /**
     * Iniciando Empresa.
     */
    public static function bootEmpresa()
    {
        if (App::runningInConsole()) {
            return 'console';
        }

        if (! config('starter.MULTISAS')) {
            return 'disabled';
        }

        static::saving(function ($model) {
            $model->prepareCompany();
        });

        if (Auth::getUser()) {
            static::addGlobalScope('company', function (Builder $builder) {
                // i need to pass a table name to avoid 'ambiguous error'
                // like that:  $builder->where($builder->getTable . '.' . self::$coluna, Auth::getUser()->company_id);
                $builder->where(self::$coluna, Auth::getUser()->company_id);
            });
        }
    }

    /**
     * Prepare Company.
     *
     * @return string|null
     */
    public function prepareCompany()
    {
        if ($this->attributes && isset($this->attributes['company_id'])) {
            return 'possui company ID';
        }

        if (Auth::getUser()) {
            $this[self::$coluna] = Auth::user()->company_id;
        }
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        if (config('starter.MULTISAS')) {
            return Hashids::encode($this->getKey());
        }

        return $this->getKey();
    }
}
