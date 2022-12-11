<?php
include "helpers.php";
$input = file_get_contents('input/test/11.txt');
$input = file_get_contents('input/11.txt');
$monkeys = explode('Monkey ',$input);

function partOne($input)
{
    return calculateMonkeyBusiness($input, 20, true);
}

function partTwo($input)
{
    return calculateMonkeyBusiness($input, 10000, false);
}

function getMonkeyInstructions($input)
{
    $monkeys = explode('Monkey ', $input);
    array_shift($monkeys);
    return array_map(function($item){
        $monkeyLines = explode("\n", $item);
        return [
            'id' => $item[0],
            'startingItems' => explode(', ', str_replace('  Starting items: ', '', $monkeyLines[1])),
            'operationNewEqualsOld' => str_replace('  Operation: new = old ', '', $monkeyLines[2]),
            'testDivisibleBy' => (int)str_replace('  Test: divisible by ', '', $monkeyLines[3]),
            'throwToIfTrue' => (int)str_replace('    If true: throw to monkey ', '', $monkeyLines[4]),
            'throwToIfFalse' => (int)str_replace('    If false: throw to monkey ', '', $monkeyLines[5]),
        ];
    }, $monkeys);
}

function calculateMonkeyBusiness($input, $rounds, $divideByThree)
{
    $monkeyInstructions = getMonkeyInstructions($input);
    $lowestCommonDivisor = array_reduce($monkeyInstructions, function($carry, $item){
        return $carry * $item['testDivisibleBy'];
    }, 1);
    $monkeyCount = count($monkeyInstructions);
    $countBuckets = array_fill(0, $monkeyCount, 0);
    $i = 0;

    while (true) {
        foreach ($monkeyInstructions[$i % $monkeyCount]['startingItems'] ?? [] as $itemValue) {
            $countBuckets[$monkeyInstructions[$i % $monkeyCount]['id']]++;
            $operationValue = (int)substr($monkeyInstructions[$i % $monkeyCount]['operationNewEqualsOld'], 2);
            if (str_contains($monkeyInstructions[$i % $monkeyCount]['operationNewEqualsOld'], '+')) {
                $newWorryLevel = $itemValue + $operationValue;
            } elseif (str_contains($monkeyInstructions[$i % $monkeyCount]['operationNewEqualsOld'], 'old')) {
                $newWorryLevel = $itemValue * $itemValue;
            } else {
                $newWorryLevel = $itemValue * $operationValue;
            }
            if($divideByThree){
                $newWorryLevel = (int)($newWorryLevel / 3);
            }else{
                $newWorryLevel = $newWorryLevel % $lowestCommonDivisor;
            }
            if ($newWorryLevel % $monkeyInstructions[$i % $monkeyCount]['testDivisibleBy'] === 0) {
                $monkeyInstructions[$monkeyInstructions[$i % $monkeyCount]['throwToIfTrue']]['startingItems'][] = $newWorryLevel;
            } else {
                $monkeyInstructions[$monkeyInstructions[$i % $monkeyCount]['throwToIfFalse']]['startingItems'][] = $newWorryLevel;
            }
            array_shift($monkeyInstructions[$i % $monkeyCount]['startingItems']);
        }
        if ($i++ / $monkeyCount == $rounds) {
            break;
        }
    }
    rsort($countBuckets);
    return $countBuckets[0] * $countBuckets[1];
}

echo 'Part 1: ' . partOne($input) . PE;
echo 'Part 2: ' . partTwo($input) . PE;
