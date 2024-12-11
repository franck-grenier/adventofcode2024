<?php

$reports = explode(PHP_EOL, file_get_contents('./input.txt'));
$validReports = 0;
$reportIsSafe = function (array $levels) {
    foreach ($levels as $key => $level) {
        if ($key === 0) {
            continue;
        }
        $direction = $levels[$key-1] <=> $level;
        $prevDirection = ($levels[$key-2] ?? 0) <=> ($levels[$key-1] ?? 0);
        if ($key === 1) {
            $direction = $prevDirection = 0;
        }
        if (
            abs($level - $levels[$key-1]) >= 1 && abs($level - $levels[$key-1]) <= 3 &&
            $prevDirection === $direction
        ) {
            // level is safe, check the next one
            continue;
        }
        else {
            // level is unsafe, stop
            return false;
        }
    }
    return true;
};

foreach ($reports as $i => $report) {
    $levels = explode(' ', $report);
    $check = $reportIsSafe($levels);

    if ($check) {
        $validReports++;
    }

    if (!$check) {
        foreach ($levels as $j => $level) {
            $newChance = $levels;
            unset($newChance[$j]);
            if ($reportIsSafe(array_values($newChance))) {
                $validReports++;
                break;
            }
        }
    }
}

print($validReports . PHP_EOL);
