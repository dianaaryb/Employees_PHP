<?php

const USERNAME = 'dianaryb';
const PASSWORD = 'c5545d';

function getConnection(): PDO {
    $host = 'db.mkalmo.eu';

    $address = sprintf('mysql:host=%s;port=3306;dbname=%s',
        $host, USERNAME);

    return new PDO($address, USERNAME, PASSWORD);
}