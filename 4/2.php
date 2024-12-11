<?php

$grid = explode(PHP_EOL, file_get_contents('./input.txt'));
$grid = array_map('str_split', $grid);
$word = 'MAS';
$total = 0;

$searchWord = function ($line, $col) use ($grid, $word) {
    $targets = [];
    $targets[] = $grid[$line-1][$col-1] . $grid[$line][$col] . $grid[$line+1][$col+1];
    $targets[] = $grid[$line-1][$col+1] . $grid[$line][$col] . $grid[$line+1][$col-1];

    return count(array_filter($targets, fn ($t) => $t === $word || $t === strrev($word))) == 2;
};

foreach ($grid as $line => $letters) {
    foreach ($letters as $col => $letter) {
        if ($letter === 'A') {
            if ($searchWord($line, $col)) $total++;
        }
    }
}

print($total . PHP_EOL);
