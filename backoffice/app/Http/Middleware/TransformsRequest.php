<?php

namespace App\Http\Middleware;

class TransformsRequest extends \Illuminate\Foundation\Http\Middleware\TransformsRequest
{
    /** @inheritDoc */
    protected function transform($key, $value)
    {
        return is_string($value) ? strip_tags($value) : $value;
    }
}
