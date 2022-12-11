<?php
include "helpers.php";
$input = file('input/test/10.txt', FILE_IGNORE_NEW_LINES);
$input = file('input/10.txt', FILE_IGNORE_NEW_LINES);

function computeCycleHistory($input){
    $registerX = 1;
    $cycles = 0;
    $cycleHistory[0] = $registerX;
    $cycleHistory[1] = $registerX;
    foreach ($input as $line){
        $cyclesToComplete = 1;
        $value = 0;
        if($line[0] == 'a'){
            $cyclesToComplete = 2;
            [$op, $value] = explode(' ', $line);
        }
        $cycles += $cyclesToComplete;
        $registerX += (int)$value;
        $cycleHistory[$cycles] = $registerX;
    }
    return $cycleHistory;
}

function partOne($input){
    $cycleHistory = computeCycleHistory($input);
    return array_reduce([20, 60, 100, 140, 180, 220], function($carry, $powerLevel) use (&$cycleHistory){
        return $carry + ($cycleHistory[$powerLevel-1] ?? $cycleHistory[$powerLevel-2]) * $powerLevel;
    });
}

function partTwo($input) {
    $cycleHistory = computeCycleHistory($input);
    return array_reduce(range(1, 40 * 6), function($carry, $pos) use (&$cycleHistory){
        $registerValue = $cycleHistory[$pos - 1] ?? $cycleHistory[$pos - 2];
        if(($registerValue <= $pos % 40) && ($pos % 40 <= $registerValue + 2)){
            return $carry . '#' . ($pos % 40 ? '' : PE);
        }
        return $carry . '.' . ($pos % 40 ? '' : PE);
    }, '');
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . PE . partTwo($input);
