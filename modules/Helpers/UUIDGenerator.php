<?php

namespace App\Modules\Helpers;

use Illuminate\Support\Str;


class UUIDGenerator
{

    public static function uuidgen($length = 8)
    {
        return Str::random($length);
    }

}