<?php

$DB_HOST = '';
$DB_USER = '';
$DB_PASS = '';
$DB_NAME = '';

$link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$link) {
    echo "Database connection error: " . mysqli_connect_error();
    exit;
}
