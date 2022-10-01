<?php
function interpolationSearch(array $myArray, mixed $num): string
{
    $start = 0;
    $last = count($myArray) - 1;

    $numberSteps = 0;
    $trueMessage = "Интерполяционный поиск , количество шагов: ";
    $falseMessage = "Значение $num отсутствует";

    while (($start <= $last) && ($num >= $myArray[$start])
        && ($num <= $myArray[$last])) {
        $numberSteps++;

        $pos = floor($start + (
                (($last - $start) / ($myArray[$last] - $myArray[$start]))
                * ($num - $myArray[$start])
            ));

        if ($myArray[$pos] == $num) {
            return $trueMessage . $numberSteps;
        }

        if ($myArray[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }

    return $falseMessage;
}