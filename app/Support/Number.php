<?php

declare(strict_types=1);

namespace App\Support;

final class Number
{
    public static function delta(int $value1, int $value2, bool $format_output = false): string
    {
        $delta = $value1 - $value2;
        $sign  = gmp_sign($delta);

        if ($format_output) {
            $delta = self::format($delta);
        }

        $output = $sign === 1 ? '+' : '';

        return $output . $delta;
    }

    public static function format(int $number): string
    {
        return number_format($number, 0, ',', ' ');
    }
}
