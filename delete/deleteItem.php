<?php
function deleteItem(array $arr, mixed $value): ?array
{
    $key = array_search($value, $arr);

    if (!$key) {
        return null;
    }

    do {
        array_splice($arr, $key, 1);
        $key = array_search($value, $arr);
    } while ($key);

    return $arr;
}

var_dump(deleteItem([4, 9, 6, 58, 6, 33, 95, 6], 6) ?? 'null');