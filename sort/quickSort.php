<?php
function quickSort(array $arr): array
{
    $size = count($arr) - 1;

    if ($size <= 0) {
        return $arr;
    }

    $base = $arr[0];

    $left = $right = [];

    for ($i = 1; $i <= $size; $i++) {
        if ($arr[$i] >= $base) {
            $right[] = $arr[$i];
        } else {
            $left[] = $arr[$i];
        }
    }

    $left = quickSort($left);
    $right = quickSort($right);

    return array_merge($left, [$base], $right);
}
