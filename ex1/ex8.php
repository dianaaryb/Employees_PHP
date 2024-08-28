<?php

require_once "ex7.php";
function getDaysUnderTempDictionary(float $targetTemp): array{
    $inputFile = fopen(__DIR__ . '/data/temperatures-filtered.csv', "r");
    $resultDictionary = array();

    while (!feof($inputFile)){
        $dict = fgetcsv($inputFile);
        if(!empty($dict) && !in_array($dict[0], array_keys($resultDictionary))){ //checks if dict[0] exists in keys
            $resultDictionary[$dict[0]] = getDaysUnderTemp($dict[0], $targetTemp);
        }
    }
    return $resultDictionary;
}

function dictToString(array $dict): string {
    $resultDictToString = '[';
    foreach ($dict as $key => $value){ //concatenate key-value pairs into a single string
        $resultDictToString .= $key . " => " . $value . ", ";
    }
    $resultDictToString = trim($resultDictToString, ", "); //removes comas, spaces from the end
    $resultDictToString .= ']';
    return $resultDictToString;
}
//print_r(getDaysUnderTempDictionary(-5.0));