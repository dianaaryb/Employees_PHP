<?php

function getAverageWinterTemp(int $winterStartYear, int $winterEndYear): float {

    $inputFile = fopen(__DIR__.'/../ex1/data/temperatures-filtered.csv', 'r');
    $count = 0;
    $averageWinterTemperature = 0.0;

    while (!feof($inputFile)){
        $dict = fgetcsv($inputFile);

        if($dict && !empty($dict[0]) && (($dict[0] == $winterStartYear && $dict[1] == 12) || ($dict[0] == $winterEndYear && $dict[1] == 1)
                || ($dict[0] == $winterEndYear && $dict[1] == 2))){
                    $averageWinterTemperature += floatval($dict[4]);
                    $count++;
        };
    }
//    var_dump($count);
    fclose($inputFile);
    if($count > 0){
        $averageWinterTemperature /= $count;
        $averageWinterTemperature = round($averageWinterTemperature, 2);
    }
    return $averageWinterTemperature;
}
//var_dump(getAverageWinterTemp(2021, 2022));
