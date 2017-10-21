<?php

namespace App\Providers;

use Monolog\Logger;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class SqlLoggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        DB::listen(function ($query) {
            foreach ($query->bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $query->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } elseif (is_string($binding)) {
                    $query->bindings[$i] = "'$binding'";
                }
            }

            // Insert bindings into query
            $query->sql = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
            $query->sql = vsprintf($query->sql, $query->bindings);

            $data['request_path'] = url()->full();
            $data['request_method'] = Request::method();
            $data['request_data'] = Request::all();

            $log = new Logger('sql');
            $log->pushHandler(new StreamHandler(storage_path().'/logs/sql-'.date('Y-m-d').'.log', Logger::INFO));
            $log->addInfo($query->sql, $data);
        });
    }
}
