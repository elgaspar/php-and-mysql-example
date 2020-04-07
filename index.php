<?php

declare(strict_types=1);

require_once 'inc/class-session.php';

$session = new Session();

if (!$session->is_logged_in()) {
    header('Location: login.php');
    exit;
}

if ($session->is_admin()) {
    header('Location: users.php');
    exit;
}

header('Location: applications.php');
exit;
