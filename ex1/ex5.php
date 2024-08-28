<?php

$sampleData = [
    ['type' => 'apple', 'weight' => 0.21],
    ['type' => 'orange', 'weight' => 0.18],
    ['type' => 'pear', 'weight' => 0.16],
    ['type' => 'apple', 'weight' => 0.22],
    ['type' => 'orange', 'weight' => 0.15],
    ['type' => 'pear', 'weight' => 0.19],
    ['type' => 'apple', 'weight' => 0.09],
    ['type' => 'orange', 'weight' => 0.24],
    ['type' => 'pear', 'weight' => 0.13],
    ['type' => 'apple', 'weight' => 0.25],
    ['type' => 'orange', 'weight' => 0.08],
    ['type' => 'pear', 'weight' => 0.20],
];

function getAverageWeightsByType(array $list): array {
    $fruit = [];
    $fruitCount = [];
    foreach ($list as $item){
        $type = $item['type'];
        $weight = $item['weight'];
        if(!in_array($type, array_keys($fruit))){ //checks if key exists in array
            $fruit[$type] = $weight;
            $fruitCount[$type] = 1;
        }else{
            $fruit[$type] += $weight;
            $fruitCount[$type]++;
        }
    }


    foreach (array_keys($fruit) as $item){
        $fruit[$item] /= $fruitCount[$item];
        $fruit[$item] = round($fruit[$item], 2);
    }
    return $fruit;
}
// testimiseks
print_r(getAverageWeightsByType($sampleData));
