<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

trait Auditando
{
    /**
     * Iniciando Auditoria.
     */
    public static function bootAuditando()
    {
        static::created(function ($model) {
            $model->auditCreation();
        });

        static::saved(function ($model) {
            $model->auditUpdate();
        });

        static::deleted(function ($model) {
            $model->auditDeletion();
        });
    }

    /**
     * Audit creation.
     *
     * @return void
     */
    public function auditCreation()
    {
        $this->audit($this->attributes, 'created');
    }

    /**
     * Audit creation.
     *
     * @return void
     */
    public function auditUpdate()
    {
        $this->audit($this->attributes, 'updated');
    }

    /**
     * Audit creation.
     *
     * @return void
     */
    public function auditDeletion()
    {
        $this->audit($this->attributes, 'deleted');
    }

    /**
     * Audit model.
     *
     * @param string $type
     *
     * @return Log
     */
    public function audit(array $log, $type)
    {
        // Log data
        $logAuditing = [
            'content_type' => $this->getMorphClass(),
            'content_id'   => $this->getKey(),
            'acao'         => $type,
            'descricao'    => $this->getCurrentRoute(),
            'detalhes'     => $log,
        ];

        Activity::log($logAuditing);
    }

    /**
     * Get the current request's route if available.
     *
     * @return string
     */
    protected function getCurrentRoute()
    {
        if (App::runningInConsole()) {
            return 'console';
        }

        return Request::fullUrl();
    }
}
