<?php

$corrupted = file_get_contents('./input.txt');

$total = 0;
$matches = [];
preg_match_all(
    '/mul\((\d*),(\d*)\)/',
    $corrupted,
    $matches,
    PREG_SET_ORDER
);

foreach ($matches as $match) {
    $total += $match[1] * $match[2];
}

print($total . PHP_EOL);
