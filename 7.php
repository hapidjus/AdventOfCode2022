<?php
include "helpers.php";
$input = file('input/test/7.txt', FILE_IGNORE_NEW_LINES);
$input = file('input/7.txt', FILE_IGNORE_NEW_LINES);

function partOne($input){
    $fileSizes = getFilesizes($input);
    return array_reduce($fileSizes, function($carry, $item){
        if($item <= 100000){
            return $carry + $item;
        }
        return $carry;
    });
}

function partTwo($input){
    $fileSizes = getFilesizes($input);
    asort($fileSizes);
    $spaceNeeded = 30000000 - (70000000 - end($fileSizes));
    foreach ($fileSizes as $size){
        if($size >= $spaceNeeded){
            return $size;
        }
    }
}

function getFilesizes($input)
{
    $dir = '';
    foreach ($input as $line){
        if(str_contains($line, '$ cd')){
            $goToDir = substr($line,5);
            if($goToDir == '..'){
                $dir = substr($dir, 0, strrpos($dir, '/'));
                array_pop($dirPath);
            }else{
                $dir .= '/' . $goToDir;
                $dirPath[] = $dir;
            }
        }elseif(! str_contains($line, '$ ls')){
            foreach ($dirPath as $path){
                $fileSizes[$path] = ($fileSizes[$path] ?? 0) + (int)explode(' ', $line)[0];
            }
        }
    }
    return $fileSizes;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
