<?php

namespace App\Traits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MangoLoversTrait
{

    public static function generateShortUUID($prefix = '')
    {
        $dateTime = date('ymdHis'); // Include hours, minutes, and seconds
        $randomNumber = random_int(0, 999999); // Generate a 6-digit random number
        $shortUUID = $prefix . $dateTime . str_pad($randomNumber, 6, '0', STR_PAD_LEFT);

        // Ensure the length is not more than 12 characters
        return substr($shortUUID, 0, 18);
    }


}
