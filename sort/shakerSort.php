<?php
function shakerSort(array $arr): array
{
    $size = count($arr) - 1;

    if ($size <= 0) {
        return $arr;
    }

    $right = $size;
    $left = 0;

    while ($right > $left) {
        for ($i = $left; $i < $right; $i++) {
            if ($arr[$i] > $arr[$i + 1]) {
                [$arr[$i], $arr[$i + 1]] = array($arr[$i + 1], $arr[$i]);
            }
        }

        $right--;
        for ($j = $right; $j > $left; $j--) {
            if ($arr[$j] < $arr[$j - 1]) {
                [$arr[$j], $arr[$j - 1]] = array($arr[$j - 1], $arr[$j]);
            }
        }

        $left++;
    }

    return $arr;
}