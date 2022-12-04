<?php
include "helpers.php";
$input = file('input/test/3.txt', FILE_IGNORE_NEW_LINES);
$input = file('input/3.txt', FILE_IGNORE_NEW_LINES);

function partOne($input){
    return array_reduce($input, function($carry, $line){
        [$left, $right] = str_split($line, strlen($line)/2);
        $intersect = array_intersect_key(count_chars($left, 1), count_chars($right, 1));
        return $carry + convertChar(array_key_first($intersect));
    });
}

function convertChar($char){
    return $char > 96 ? $char - 96 : $char - 38;
}

function partTwo($input){
    $arraysOfTrees = array_chunk($input, 3);
    return array_reduce($arraysOfTrees, function($carry, $lines){
        $diff = array_intersect_key(count_chars($lines[0], 1), count_chars($lines[1], 1), count_chars($lines[2], 1));
        return $carry + convertChar(array_key_first($diff));
    });
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;