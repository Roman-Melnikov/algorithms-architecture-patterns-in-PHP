<?php
$directory = '../Projects studies/5. React. Базовый курс';

$iter = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($directory)
);

foreach ($iter as $file) {
    echo 'Имя файла: ' . $iter->getSubPathName() . "\n";
    echo 'Поддиректория: ' . $iter->getSubPath() . "\n\n";
}