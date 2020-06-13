<?php

declare(strict_types=1);

function delta(int $value1, int $value2)
{
    $delta = $value1 - $value2;
    $sign  = gmp_sign($delta);

    $output = $sign === 1 ? '+' : '';

    return $output . $delta;
}

function number_formating(int $number)
{
    return number_format($number, 0, ',', ' ');
}
