<?php
include "helpers.php";
$input = file_get_contents('input/test/5.txt', FILE_IGNORE_NEW_LINES);
$input = file_get_contents('input/5.txt', FILE_IGNORE_NEW_LINES);

function partOne($input){
    [$map, $instructions] = explode(PE.PE, $input);
    $mapArray = mapArray($map);
    foreach (explode(PE, $instructions) as $instruction){
        [$null, $crates, $null, $fromPosition, $null, $toPosition] = explode(' ', $instruction);
        for ($i = 0; $i < $crates; $i++){
            array_unshift($mapArray[$toPosition], array_shift($mapArray[$fromPosition]));
        }
    }
    return array_reduce($mapArray, function($carry, $line){
        return $carry . array_shift($line);
    });
}

function mapArray($input){
    foreach(explode(PE, $input) as $line){
        foreach(str_split($line, 4) as $key => $value){
            if(str_contains($value, ']')){
                $mapArray[$key+1][] = $value[1];
            }
        }
    }
    ksort($mapArray);
    return $mapArray;
}

function partTwo($input){
    [$map, $instructions] = explode(PE.PE, $input);
    $mapArray = mapArray($map);
    foreach (explode(PE, $instructions) as $instruction){
        [$null, $crates, $null, $fromPosition, $null, $toPosition] = explode(' ', $instruction);
        $fromValue = [];
        for ($i = 0; $i < $crates; $i++){
            array_unshift($fromValue, array_shift($mapArray[$fromPosition]));
        }
        foreach ($fromValue as $value){
            array_unshift($mapArray[$toPosition], $value);
        }
    }
    return array_reduce($mapArray, function($carry, $line){
        return $carry . array_shift($line);
    });
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
