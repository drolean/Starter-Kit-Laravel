<?php

namespace App\Helpers;

use ReflectionClass;
use Psr\Log\LogLevel;
use Illuminate\Support\Facades\File;

class LogView
{
    /**
     * @var string file
     */
    private static $file;

    /**
     * @return array
     */
    public static function all()
    {
        $log = [];

        $log_levels = self::getLogLevels();

        $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*/';

        if (! self::$file) {
            $log_file = self::getFiles();
            if (! count($log_file)) {
                return [];
            }
            self::$file = $log_file[0];
        }

        $file = File::get(self::$file);

        preg_match_all($pattern, $file, $headings);

        if (! is_array($headings)) {
            return $log;
        }

        $log_data = preg_split($pattern, $file);

        if ($log_data[0] < 1) {
            array_shift($log_data);
        }

        foreach ($headings as $h) {
            for ($i = 0, $j = count($h); $i < $j; $i++) {
                foreach ($log_levels as $level_key => $level_value) {
                    if (strpos(strtolower($h[$i]), '.'.$level_value)) {
                        preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\].*?\.'.$level_key.': (.*?)( in .*?:[0-9]+)?$/', $h[$i], $current);

                        if (! isset($current[2])) {
                            continue;
                        }

                        $log[] = [
                            'level'   => $level_value,
                            'date'    => $current[1],
                            'text'    => $current[2],
                            'in_file' => isset($current[3]) ? $current[3] : null,
                            'stack'   => preg_replace("/^\n*/", '', $log_data[$i]),
                        ];
                    }
                }
            }
        }

        return array_reverse($log);
    }

    /**
     * @param bool $basename
     *
     * @return array
     */
    public static function getFiles($basename = false)
    {
        $files = glob(storage_path().'/logs/*');
        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');
        if ($basename && is_array($files)) {
            foreach ($files as $k => $file) {
                $files[$k] = basename($file);
            }
        }

        return array_values($files);
    }

    /**
     * @return array
     */
    private static function getLogLevels()
    {
        $class = new ReflectionClass(new LogLevel());

        return $class->getConstants();
    }
}
