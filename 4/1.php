<?php

$grid = explode(PHP_EOL, file_get_contents('./input.txt'));
$grid = array_map('str_split', $grid);
$word = 'XMAS';
$total = 0;

$searchWord = function ($line, $col) use ($grid, $word) {
    $targets = [];
    $targets[] = $grid[$line][$col].$grid[$line-1][$col-1].$grid[$line-2][$col-2].$grid[$line-3][$col-3];
    $targets[] = $grid[$line][$col].$grid[$line-1][$col].$grid[$line-2][$col].$grid[$line-3][$col];
    $targets[] = $grid[$line][$col].$grid[$line-1][$col+1].$grid[$line-2][$col+2].$grid[$line-3][$col+3];
    $targets[] = $grid[$line][$col].$grid[$line][$col+1].$grid[$line][$col+2].$grid[$line][$col+3];
    $targets[] = $grid[$line][$col].$grid[$line+1][$col+1].$grid[$line+2][$col+2].$grid[$line+3][$col+3];
    $targets[] = $grid[$line][$col].$grid[$line+1][$col].$grid[$line+2][$col].$grid[$line+3][$col];
    $targets[] = $grid[$line][$col].$grid[$line+1][$col-1].$grid[$line+2][$col-2].$grid[$line+3][$col-3];
    $targets[] = $grid[$line][$col].$grid[$line][$col-1].$grid[$line][$col-2].$grid[$line][$col-3];

    return count(array_filter($targets, fn ($t) => $t === $word));
};

foreach ($grid as $line => $letters) {
    foreach ($letters as $col => $letter) {
        if ($letter === 'X') {
            $total += $searchWord($line, $col);
        }
    }
}

print($total . PHP_EOL);
