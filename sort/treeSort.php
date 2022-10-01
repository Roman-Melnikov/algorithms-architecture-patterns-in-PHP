<?php
function treeSort(array $arr): array
{
    $size = count($arr) - 1;

    if ($size <= 0) {
        return $arr;
    }

    $heap = new SplMinHeap();

    for ($i = 0; $i <= $size; $i++) {
        $heap->insert($arr[$i]);
    }

    $arraySort = [];
    while ($heap->valid()) {
        $arraySort[] = $heap->top();
        $heap->next();
    }

    return $arraySort;
}