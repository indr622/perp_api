<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * name: GeneralUtils.php
 * Date: 2022-12-28
 */

namespace App\Util;

use Carbon\Carbon;

class GeneralUtils
{


    public function checkInputString($input, $value = "")
    {
        return isset($input) && !empty($input) ? $input : $value;
    }

    public function checkNumber($number, $default = 1)
    {
        $number = isset($number) ? ((is_numeric($number) && (int) $number >= 1) ? (int) $number : $default) : $default;
        return $number;
    }

    public function checkDate($inputDate, $default = 0)
    {
        try {
            return Carbon::createFromFormat('Y-m-d', $inputDate);
        } catch (\Exception $e) {
            return Carbon::now()->addDays($default);
        }
    }
}
