<?php
include "helpers.php";
$input = file_get_contents('input/test/1.txt');
$input = file_get_contents('input/1.txt');

function partOne($input){
    return max(groupInBuckets($input));
}

function groupInBuckets($input){
    $elfBuckets = explode(PE.PE, $input);
    return $caloriesPerElf = array_map(function ($calorieLines){
        return array_sum(explode(PE, $calorieLines));
    }, $elfBuckets);
}

function partTwo($input){
    $elfBuckets = groupInBuckets($input);
    rsort($elfBuckets);
    return array_sum(array_slice($elfBuckets, 0, 3));
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
