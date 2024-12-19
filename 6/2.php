<?php

$content = explode(PHP_EOL.PHP_EOL, file_get_contents('./input.txt'));
$rules = explode(PHP_EOL, $content[0]);
$updates = array_map(fn ($u) => explode(',', $u), explode(PHP_EOL, $content[1]));
$fixedUpdates = [];
$middlePages = [];

$orderPages = function ($a, $b) use ($rules) {
    $result = 0;
    $applyingRule = explode('|', array_values(array_filter($rules, fn ($r) => str_contains($r, $a) && str_contains($r, $b)))[0] ?? '');
    if ($applyingRule[0] == $a && $applyingRule[1] == $b) {
        $result = -1;
    }
    if ($applyingRule[0] == $b && $applyingRule[1] == $a) {
        $result =  1;
    }
    return $result;
};

foreach ($updates as $pages) {
    $orderedPages = $pages;
    usort($orderedPages, $orderPages);
    if ($orderedPages !== $pages) {
        $fixedUpdates[] = $orderedPages;
    }
}

foreach ($fixedUpdates as $key => $update) {
    $middlePages[] = $update[floor(count($update) / 2)];
}

print(array_sum($middlePages) . PHP_EOL);
