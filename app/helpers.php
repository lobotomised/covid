<?php


function delta(int $value1, int $value2) {
    $delta = $value1 - $value2;
    $signe = gmp_sign($delta);

    if($signe === 1) {
        $output = '+';
    } else {
        if($signe === -1) {
            $output = '-1';
        } else {
            $output = '';
        }
    }

    return $output . $delta;
}
