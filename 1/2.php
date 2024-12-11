<?php

$input = explode(PHP_EOL, file_get_contents('./input.txt'));
$leftList = [];
$rightList = [];

foreach ($input as $locations) {
    $leftList[] = explode('   ', $locations)[0];
    $rightList[] = explode('   ', $locations)[1];
}

sort($leftList);
sort($rightList);

$similarities = [];
foreach ($leftList as $left) {
    $matchings = array_filter($rightList, fn ($right) => $right === $left);
    if (count($matchings)) {
        $similarities[] = $left * count($matchings);
    }
}

print(array_sum($similarities) . PHP_EOL);
