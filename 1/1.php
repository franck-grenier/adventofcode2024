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

$distance = 0;
for ($i = 0; $i < count($leftList); $i++) {
    $distance += abs($leftList[$i] - $rightList[$i]);
}

print($distance . PHP_EOL);
