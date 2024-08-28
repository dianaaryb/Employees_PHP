<?php

ini_set('display_errors', '1');

require_once '../ex1/ex7.php';
require_once '../ex2/functions.php';

$command = $_POST['command'] ?? 'show-form';
$year = $_POST['year'] ?? 'show-form';
$temp = $_POST['temp'] ?? 'show-form';
$page = $_GET['page'] ?? 'show-form';

if ($command === 'show-form') {

    if($page === 'avg-winter-temp') {

    include 'pages/avg-winter-temp.php';

    }else{
        include 'pages/days-under-temp.php';
    }

} else if ($command === 'days-under-temp') {

    $message = getDaysUnderTemp($year, $temp);
    include 'pages/result.php';

} else if($command === 'avg-winter-temp') {

    $result = explode('/', $year);
    $message = getAverageWinterTemp($result[0], $result[1]);
    include 'pages/result.php';

} else {
    throw new Error('unknown command: ' . $command);
}
