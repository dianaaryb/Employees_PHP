<?php

$list = [1, 2, 3, 2, 6];

function isInList($list, $target): bool {
    for ($i = 0; $i < count($list); $i++){
        if($list[$i] === $target){
            return true;
        }
    }
//    in_array($target, $list);
    return false;
}
var_dump(isInList([1, 2, 3], 2)); //true
var_dump(isInList([1, 2, 3], 4)); //false
var_dump(isInList([1, 2, 3], '2')); //false

//print(isInList([1, 2, 3], 2)); //true
//print(isInList([1, 2, 3], 4)); //false
//print(isInList([1, 2, 3], '2')); //false





