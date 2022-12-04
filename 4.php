<?php
include "helpers.php";
$input = file('input/test/4.txt', FILE_IGNORE_NEW_LINES);
$input = file('input/4.txt', FILE_IGNORE_NEW_LINES);

function partOne($input){
    return array_reduce($input, function($carry, $line){
        [$left, $right] = explode(',', $line);
        [$leftMin, $leftMax] = explode('-', $left);
        [$rightMin, $rightMax] = explode('-', $right);
        if(($leftMin <= $rightMin && $rightMax <= $leftMax) || ($rightMin <= $leftMin && $leftMax <= $rightMax)){
            return ++$carry;
        }
        return $carry;
    });

}

function partTwo($input){
    return array_reduce($input, function($carry, $line){
        [$left, $right] = explode(',', $line);
        [$leftMin, $leftMax] = explode('-', $left);
        [$rightMin, $rightMax] = explode('-', $right);
        if($leftMax < $rightMin || $leftMin > $rightMax ){
            return $carry;
        }
        return ++$carry;
    });
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
