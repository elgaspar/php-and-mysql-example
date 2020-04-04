<?php

$config = parse_ini_file('config.ini');

$db_connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);

if (!$db_connection) {
    echo "Database connection error: " . mysqli_connect_error();
    exit;
}
