<?php

declare(strict_types=1);

require_once 'inc/class-utilities.php';

if (!isset($_POST['email'], $_POST['password'])) {
    header('Location: login.php');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];



session_start();

$user = Utilities::user_login($email, $password);
if ($user) {
    $_SESSION['logged_in'] = true;
    $_SESSION['id'] = $user->get_id();
    $_SESSION['email'] = $user->get_email();
    $_SESSION['first_name'] = $user->get_first_name();
    $_SESSION['last_name'] = $user->get_last_name();
    $_SESSION['is_admin'] = $user->is_admin();

    header('Location: applications.php');
    exit;
} else {
    $_SESSION['login_error'] = true;

    header('Location: login.php');
    exit;
}
