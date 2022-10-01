<?php
function bubbleSort(array $arr): array
{
    $size = count($arr) - 1;

    if ($size <= 0) {
        return $arr;
    }

    for ($i = $size; $i > 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                [$arr[$j], $arr[$j + 1]] = array($arr[$j + 1], $arr[$j]);
            }
        }
    }

    return $arr;
}