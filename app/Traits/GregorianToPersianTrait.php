<?php

namespace App\Traits;

use DateTime;
use Hekmatinasser\Verta\Verta;

trait GregorianToPersianTrait
{

    public function gregorianDateToPersian($gregorianDateTime)
    {
        $gregorianDateTime = new DateTime($gregorianDateTime);
        $gregorianDate = $gregorianDateTime->format('Y/m/d');

        $gregorainDateArr = array_map('intval', explode('/', $gregorianDate));

        $persianDateArr = Verta::getJalali($gregorainDateArr[0], $gregorainDateArr[1], $gregorainDateArr[2]);

        $persianDate = implode('/', $persianDateArr);

        return $persianDate;
    }
}
