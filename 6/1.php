<?php

$lab = explode(PHP_EOL, file_get_contents('./input.txt'));
$lab = array_map(fn ($line) => str_split($line), $lab);
$directions = ['^', '>', 'v', '<'];
$starter = $directions[0];
$blocker = '#';
$startPos = [0,0];

foreach($lab as $row => $line)
{
    $col = array_find_key($line, fn ($item) => $item === $starter);
    if ($col) {
        $startPos = [$row, $col];
    }
}

$guardPositions = 0;
$row = $startPos[0];
$col = $startPos[1];
$direction = $starter;

while(($row >= 0 && $row < count($lab)) && ($col >= 0 && $col < count($lab[0]))) {
    // up
    if ($direction == $directions[0]) {
        if (! isset($lab[$row-1][$col])) {
            $row--; // get out
        }
        elseif ($lab[$row-1][$col] !== $blocker) {
            $lab[$row-1][$col] = 'X';
            $row--;
        }
        else {
            $direction = $directions[1];
        }
    }
    // right
    if ($direction == $directions[1]) {
        if (! isset($lab[$row][$col+1])) {
            $col++; // get out
        }
        elseif ($lab[$row][$col+1] !== $blocker) {
            $lab[$row][$col+1] = 'X';
            $col++;
        }
        else {
            $direction = $directions[2];
        }
    }
    // down
    if ($direction == $directions[2]) {
        if (! isset($lab[$row+1][$col])) {
            $row++; // get out
        }
        elseif ($lab[$row+1][$col] !== $blocker) {
            $lab[$row+1][$col] = 'X';
            $row++;
        }
        else {
            $direction = $directions[3];
        }
    }
    // left
    if ($direction == $directions[3]) {
        if (! isset($lab[$row][$col-1])) {
            $col--; // get out
        }
        elseif ($lab[$row][$col-1] !== $blocker) {
            $lab[$row][$col-1] = 'X';
            $col--;
        }
        else {
            $direction = $directions[0];

        }
    }
}

foreach($lab as $line)
{
    foreach ($line as $pos)
    {
        if ($pos === 'X' || $pos === $starter) {
            $guardPositions++;
        }
    }
}

print($guardPositions . PHP_EOL);
