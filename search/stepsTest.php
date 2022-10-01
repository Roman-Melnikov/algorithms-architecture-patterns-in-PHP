<?php
include_once 'binarySearch.php';
include_once 'interpolationSearch.php';
include_once './sort/randArray.php';
include_once './sort/treeSort.php';

$randArray = randArray();
$mergeArray = array_merge($randArray, [10]);
$sortArray = treeSort($mergeArray);

$binarySteps = binarySearch(
    $sortArray,
    10
);

$interpolationSteps = interpolationSearch(
    $sortArray,
    10
);

echo $binarySteps . PHP_EOL;
echo $interpolationSteps;