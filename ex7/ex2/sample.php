<?php

require_once '../vendor/tpl.php';
require_once '../OrderLine.php';

$orderLines = [
    new OrderLine('Pen', 1, true),
    new OrderLine('Paper', 3, false),
    new OrderLine('Staples', 2, true)];


