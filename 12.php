<?php
include "helpers.php";
$input = file_get_contents('input/test/12.txt');
$input = file_get_contents('input/12.txt');

function partOne($input){
    return dijkstraWalkStopOnChars($input, 'S', 'a');
}

function partTwo($input){
    return dijkstraWalkStopOnChars($input, 'a', 'b');
}

function dijkstraWalkStopOnChars($input, $lastValue, $secondToLastValue){
    $width = strpos($input, "\n");
    $height = substr_count($input, "\n") + 1;
    $inputWithoutLineBreak = str_replace("\n", '', $input);
    // Set up start position
    $current = strpos($inputWithoutLineBreak, 'E');
    // Change start char to enable travel
    $inputWithoutLineBreak[$current] = 'z';
    $visited = [];
    $distances[$current] = 0;
    while(true){
        $currentNodeValue = $inputWithoutLineBreak[$current];
        foreach(get_neighbours($visited, $current, $width, $height) as $visitNode){
            $visitNodeValue = $inputWithoutLineBreak[$visitNode];
            // Return if path completed
            if( $visitNodeValue == $lastValue && $currentNodeValue == $secondToLastValue){
                return $distances[$current] + 1;
            }
            // Test if allowed to travel
            if( ord($currentNodeValue) <= ord($visitNodeValue) + 1 ){
                // Set distance for node to the least of its current and newly calculated value
                $distances[$visitNode] = min($distances[$visitNode] ?? PHP_INT_MAX, $distances[$current] + 1);
            }
        }
        $visited[$current] = $current;
        // Make the unvisited node with the least distance the current one
        $leftToVisit = array_diff_key($distances, $visited);
        asort($leftToVisit);
        $current = array_key_first($leftToVisit);
    }
}

function get_neighbours(&$visited, $current, $width, $height)
{
    $length = $width * $height;
    $neighbours = [];
    //Up - return if current is in > row 1
    if($current > $width){
        $neighbours[] = $current - $width;
    }
    //Down - return if current not in last row
    if($length - $current > $width){
        $neighbours[] = $current + $width;
    }
    //Left - return if not in leftmost row
    if($current % $width !== 0) {
        $neighbours[] = $current - 1;
    }
    //Right - return if not in rightmost row
    if($current % $width !== $width - 1) {
        $neighbours[] = $current + 1;
    }
    return array_diff($neighbours, $visited);
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;

