<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class GenderStatus extends Enum
{
    const man = 1;
    const woman = 2;

    public static function getGenderStatus($value): string
    {
        switch ($value) {
            case self::man:
                return '男性';
                brake;
            case self::woman:
                return '女性';
                brake;
            default:
                //return self::getGenderStatus($value);
                return '';
        }
    }

}
