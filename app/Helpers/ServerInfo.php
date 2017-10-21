<?php

namespace App\Helpers;

use DB;
use Carbon\Carbon;

class ServerInfo
{
    /**
     * retorna informações do sistema operacional.
     *
     * @return array
     */
    public static function getOSInformation()
    {
        if (false === function_exists('glob')) {
            return;
        }

        $vars = [];
        $files = glob('/etc/*-release');

        foreach ($files as $file) {
            $lines = array_filter(array_map(function ($line) {
                $parts = explode('=', $line);

                if (count($parts) !== 2) {
                    return false;
                }

                $parts[1] = str_replace(['"', "'"], '', $parts[1]);

                return $parts;
            }, file($file)));

            foreach ($lines as $line) {
                $vars[$line[0]] = $line[1];
            }
        }

        return $vars;
    }

    /**
     * retorna informações do kernel do servidor.
     *
     * @return string
     */
    public static function getKernelVersion()
    {
        if (false === function_exists('shell_exec') || false === is_readable('/proc/version')) {
            return;
        }

        $kernel = explode(' ', shell_exec('cat /proc/version'));
        $kernel = $kernel['2'];

        return $kernel;
    }

    /**
     * retorna o uptime do servidor.
     *
     * @return string
     */
    public static function getUptime()
    {
        if (false === function_exists('shell_exec') || false === is_readable('/proc/uptime')) {
            return;
        }

        $tmp = explode(' ', shell_exec('cat /proc/uptime'));
        $str = time() - intval($tmp[0]);

        return Carbon::createFromFormat('U', $str);
    }

    /**
     * executa ping a um host determinado.
     *
     * @param string $host    [description]
     * @param int    $timeout [description]
     *
     * @return int
     */
    public static function ping($host, $timeout = 10)
    {
        $output = [];
        $com = 'ping -n -w '.$timeout.' -c 1 '.escapeshellarg($host);

        $exitcode = 0;
        exec($com, $output, $exitcode);
        if ($exitcode === 0 || $exitcode === 1) {
            foreach ($output as $cline) {
                if (strpos($cline, ' bytes from ') !== false) {
                    $out = (int) ceil(floatval(substr($cline, strpos($cline, 'time=') + 5)));

                    return $out;
                }
            }
        }

        return false;
    }

    /**
     * retorna a versão do mysql.
     *
     * @return string
     */
    public static function getMysqlVersion()
    {
        $pdo = DB::connection()->getPdo();
        $version = $pdo->query('select version()')->fetchColumn();

        $version = mb_substr($version, 0, 6);

        return $version;
    }
}
