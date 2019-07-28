<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 28.07.2019
 * Time: 23:34
 */

namespace App\Validators;


class DateValidator
{
    public function validate($date)
    {
        $parseDate = explode('-', $date);
        $year = $parseDate[0];
        $month = $parseDate[1];
        $day = $parseDate[2];

        return checkdate($month, $day, $year);
    }
}
