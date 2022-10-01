<?php
function binarySearch(array $myArray,mixed $num): string
{
    $left = 0;
    $right = count($myArray) - 1;

    $numberSteps = 0;
    $trueMessage = "Бинарный поиск , количество шагов: ";
    $falseMessage = "Значение $num отсутствует";

    while ($left <= $right) {
        $numberSteps++;

        $middle = floor(($right + $left) / 2);

        if ($myArray[$middle] === $num) {
            return $trueMessage . $numberSteps;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }

    return $falseMessage;
}