<?php
include "helpers.php";
$input = file_get_contents('input/test/6.txt', FILE_IGNORE_NEW_LINES);
$input = file_get_contents('input/6.txt', FILE_IGNORE_NEW_LINES);

function partOne($input){
    return breakOnUniqueSequence($input, 4);
}

function partTwo($input){
    return breakOnUniqueSequence($input, 14);
}

function breakOnUniqueSequence($input, $length){
    $input = str_split($input, 1);
    $currentSelection = [];
    foreach ($input as $key => $value){
        $currentSelection[] = $value;
        if(count($currentSelection) > $length){
            array_shift($currentSelection);
            if(!array_diff_key($currentSelection , array_unique($currentSelection))){
                return $key+1;
            }
        }
    }
    return null;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
