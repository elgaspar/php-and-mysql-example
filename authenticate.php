<?php

if (!isset($_POST['email'], $_POST['password'])) {
    header('Location: login.php');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

require_once 'db-connect.php';

$results = $db_connection->prepare("SELECT id, password, first_name, last_name, user_type FROM users WHERE email = ?");
$results->bind_param("s", $email);
$results->execute();
$results->store_result();
$results->bind_result($id, $password_hash, $first_name, $last_name, $user_type);
$results->fetch();
$results->close();

session_start();

if (password_verify($password, $password_hash)) {
    $_SESSION['logged_in'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['user_type'] = $user_type;

    header('Location: applications.php');
    exit;
} else {
    $_SESSION['login_error'] = true;
    header('Location: index.php');
    exit;
}
