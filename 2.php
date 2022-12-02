<?php
include "helpers.php";
$input = file('input/test/2.txt');
$input = file('input/2.txt');

$moveScores['X'] = 1; // X for Rock 1p
$moveScores['Y'] = 2; // Y for Paper 2p
$moveScores['Z'] = 3; // Z for Scissors 3p

$outcomeScores['L'] = 0;
$outcomeScores['D'] = 3;
$outcomeScores['W'] = 6;

function partOne($input){
    global $outcomeScores;
    global $moveScores;

    return array_reduce($input, function($carry, $line) use (&$moveScores, &$outcomeScores){
        return $carry + $moveScores[$line[2]] + $outcomeScores[calculateOutcomePartOne($line[0], $line[2])];
    });
}

function calculateOutcomePartOne($opponentMove, $myMove){
    $resultMatrix = [
        'A X' => 'D',
        'A Y' => 'W',
        'A Z' => 'L',
        'B X' => 'L',
        'B Y' => 'D',
        'B Z' => 'W',
        'C X' => 'W',
        'C Y' => 'L',
        'C Z' => 'D',
    ];
    return $resultMatrix[$opponentMove . ' ' . $myMove];
}

function partTwo($input){
    global $moveScores;

    $outcomeScores['Z'] = 6;
    $outcomeScores['Y'] = 3;
    $outcomeScores['X'] = 0;

    return array_reduce($input, function($carry, $line) use (&$moveScores, &$outcomeScores){
        return $carry + $moveScores[calculateMovePartTwo($line[0], $line[2])] + $outcomeScores[$line[2]];
    });
}

function calculateMovePartTwo($opponentMove, $myMove){
    // X means you need to lose
    // Y means you need draw
    // Z means you need to win.
    $shouldPlayMoveMatrix = [
        'A X' => 'Z',
        'A Y' => 'X',
        'A Z' => 'Y',
        'B X' => 'X',
        'B Y' => 'Y',
        'B Z' => 'Z',
        'C X' => 'Y',
        'C Y' => 'Z',
        'C Z' => 'X',
    ];
    return $shouldPlayMoveMatrix[$opponentMove . ' ' . $myMove];
}
echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
