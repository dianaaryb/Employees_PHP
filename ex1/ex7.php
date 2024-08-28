<?php

function getDaysUnderTemp(int $targetYear, float $targetTemp): float {
    $inputFile = fopen(__DIR__ . "/data/temperatures-filtered.csv", "r");

    $days = 0;

    while (!feof($inputFile)){
        $dict = fgetcsv($inputFile);

        if(is_array($dict) && !empty($dict[0])){
            $year = intval($dict[0]);
//            var_dump($year);
            $temperature = floatval($dict[4]);

//            var_dump($temperature);

            if($year == $targetYear && $temperature <= $targetTemp){
                $days++;
            }
        }
    }
    fclose($inputFile);
    return round($days / 24, 2);
}
