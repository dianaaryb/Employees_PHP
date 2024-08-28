<?php

$input = '[1, 4, 2, 0]';

function stringToIntegerList(string $input): array
{
    $resultList = [];
    $replacedList = str_replace(['[', ']', ' '], '', $input); //eemaldab sõnest alamsõne
//    print($replacedList);
    $explodedReplacedList = explode(',', $replacedList); //teeb sõne osadeks
//    print_r($explodedReplacedList);
    foreach ($explodedReplacedList as $each) {
        $resultList[] = intval($each); //teisendab sõne täisarvuks
    }
    return $resultList;
}

print_r(stringToIntegerList('[1, 4, 2, 0]'));
// check that the restored list is the same as the input list.
var_dump( stringToIntegerList('[1, 4, 2, 0]') === [1, 4, 2, 0]); // should print "bool(true)"


