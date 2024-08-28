<?php

$numbers = [1, 2, '3', 6, 2, 3, 2, 3];

$count = 0;

for ($i = 0; $i < count($numbers); $i++){
    if($numbers[$i] === 3){
        $count++;
    }
    //$number === 3 ? $count++ : null;
}

print "Found it $count times";
