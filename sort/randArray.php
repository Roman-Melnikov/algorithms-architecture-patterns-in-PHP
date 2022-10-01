<?php
const SIZE = 5000;
const MIN_NUMBER = 1;
const MAX_NUMBER = 500;

function randArray(
    $size = SIZE,
    $minNumber = MIN_NUMBER,
    $maxNumber = MAX_NUMBER
): array
{
    $randArray = [];
    for ($i = 0; $i < $size; $i++) {
        $randArray[] = random_int($minNumber, $maxNumber);
    }

    return $randArray;
}

