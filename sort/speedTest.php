<?php
include_once 'randArray.php';
include_once 'bubbleSort.php';
include_once 'shakerSort.php';
include_once 'quickSort.php';
include_once 'treeSort.php';

ini_set('xdebug.max_nesting_level', 50000);
ini_set('memory_limit', '1024M');

$randArray = randArray();

$start = microtime(true);
sort($randArray);
echo 'Сортировка из PHP ' . microtime(true) - $start . PHP_EOL;

$start = microtime(true);
bubbleSort($randArray);
echo 'Сортировка пузырьком ' . microtime(true) - $start . PHP_EOL;

$start = microtime(true);
shakerSort($randArray);
echo 'Сортировка шейкерная ' . microtime(true) - $start . PHP_EOL;

$start = microtime(true);
quickSort($randArray);
echo 'Сортировка быстрая ' . microtime(true) - $start . PHP_EOL;

$start = microtime(true);
treeSort($randArray);
echo 'Сортировка пирамидальная ' . microtime(true) - $start . PHP_EOL;
