<?php

$inputFile = fopen(__DIR__."/data/temperatures-sample.csv", "r");
$outputFile = fopen("temperatures-filtered.csv", "w");

while(!feof($inputFile)) { //kui ei ole end of file, niikaua loopime
    $dict = fgetcsv($inputFile); //reads one line ja tagastab sonastiku kujul
    //        var_dump($dict[0]); //esimene element reast
    if(is_array($dict) && !empty($dict[0]) && !is_numeric($dict[0])){ //checks if dict is array and not empty and not numeric
        fputcsv($outputFile, [$dict[0], $dict[1], $dict[2], $dict[3], $dict[9]]);
    }

    if($dict && is_numeric($dict[0])){

        $year = intval($dict[0]);

        $month = intval($dict[1]);

        $day = intval($dict[2]);

        $hours = explode(":", $dict[3]);
        $hoursSeparately = intval($hours[0]);
//        var_dump($hoursSeparately);
        $temperature = intval($dict[9]);

        if($year == 2004 || $year == 2022){
            fputcsv($outputFile, [$year, $month, $day, $hoursSeparately, $temperature]);
        }
    }

}
fclose($inputFile);
fclose($outputFile);


