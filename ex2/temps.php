<?php

require_once '../ex1/ex7.php';
require_once '../ex1/ex8.php';

require_once 'functions.php'; // separate functions from main program

$opts = getopt('c:y:t:', ['command:', 'year:', 'temp:']);

$command = $opts['command'] ?? null;
$year = $opts['year'] ?? null;
$temp = $opts['temp'] ?? null;

if ($command === 'days-under-temp') {
    // validate that required parameters are provided
    if (!isset($year) || !isset($temp)) {
        showError('parameter is missing or is unknown');
    }
    print_r(getDaysUnderTemp($year, $temp));
    // if not show error and exit
    // calculate result using getDaysUnderTemp()
    // print result

} else if ($command === 'days-under-temp-dict') {
    if (!isset($temp)) {
        showError('parameter is missing or is unknown');
    }
    $result = getDaysUnderTempDictionary($temp);
    print_r(dictToString($result));
    // validate that required parameters are provided
    // if not show error and exit
    // calculate result using getDaysUnderTempDictionary()
    // print result
} else if ($command === 'avg-winter-temp') {
    $result = explode('/', $year);
    if (!isset($result)) {
        showError('parameter is missing or is unknown');
    }
    print getAverageWinterTemp($result[0], $result[1]);
} else {
    showError('command is missing or is unknown');
}


function showError(string $message): void {
    fwrite(STDERR, $message . PHP_EOL);
    exit(1);
}
