<?php

namespace App\Traits;

trait SaveToUpper
{
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        $encoding = mb_internal_encoding();

        if (is_string($value) && (preg_match('~[0-9]~', $value)) === 0) {
            $this->attributes[$key] = trim(mb_strtoupper($value, $encoding));
        }
    }
}
