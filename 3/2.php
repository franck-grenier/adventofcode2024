<?php

$corrupted = file_get_contents('./input.txt');

$total = 0;
$matches = [];
preg_match_all(
    '/don\'t\(\)|do\(\)|mul\((\d*),(\d*)\)/',
    $corrupted,
    $matches,
    PREG_SET_ORDER
);
$do = true;
foreach ($matches as $match) {
    if ($match[0] === "do()") {
        $do = true;
    } elseif ($match[0] === "don't()") {
        $do = false;
    }
    if ($do) {
        $total += ($match[1] ?? 0) * ($match[2] ?? 0);
    }
}

print($total . PHP_EOL);
