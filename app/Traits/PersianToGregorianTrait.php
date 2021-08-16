<?php

namespace App\Traits;

use Hekmatinasser\Verta\Verta;

trait PersianToGregorianTrait
{
    
    public function persianDateToGregorian($persianDate)
    {
        $persianDateArr = array_map('intval', explode('/', $persianDate));

        $gregorianDateArr = Verta::getGregorian($persianDateArr[0], $persianDateArr[1], $persianDateArr[2]);

        $gregorianDate = implode('/', $gregorianDateArr);

        return $gregorianDate;
    }
}