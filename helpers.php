<?php

CONST PE = PHP_EOL;
CONST BR = '<br>';

function dp($input){
    echo '<pre>';
	var_dump($input);
    echo '</pre>';
	die();
}

function dump($input)
{
    var_dump($input);
}

function dd($input){
	var_dump($input);
	die();
}

function pause() {
    $handle = fopen ("php://stdin","r");
    do { $line = fgets($handle); } while ($line == '');
    fclose($handle);
    return $line;
}
