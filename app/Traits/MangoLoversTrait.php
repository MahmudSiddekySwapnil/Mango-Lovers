<?php

namespace App\Traits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MangoLoversTrait
{

    public static function generateShortUUID($prefix = '')
    {
        $dateTime = date('ymd'); // Date format yymd
        $randomNumber = mt_rand(0, 9999); // Generate a random number
        $shortUUID = $prefix . $dateTime . str_pad($randomNumber, 4, '0', STR_PAD_LEFT);

        // Ensure the length is not more than 8 characters
        return substr($shortUUID, 0, 8);
    }
}
