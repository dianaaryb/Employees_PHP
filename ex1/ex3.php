<?php

$list = [1, 2, 3];

function listToString(array $list): string {
    $numStrings = implode(", ", $list); //join list -> string
    return "[" . $numStrings . "]";
}


print(listToString([1, 2, 3])); //"[1, 2, 3]"





