<?php

declare(strict_types=1);

namespace App\Support;

final class Number
{
    public static function delta(int $value1, int $value2): string
    {
        $delta = $value1 - $value2;
        $sign  = gmp_sign($delta);

        $output = $sign === 1 ? '+' : '';

        return $output . $delta;
    }

    public static function format(int $number)
    {
        return number_format($number, 0, ',', ' ');
    }
}
