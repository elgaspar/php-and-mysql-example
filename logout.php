<?php

declare(strict_types=1);

require_once 'inc/class-session.php';

session_start();
Session::clear_logged_in_user();

header('Location: index.php');
exit;
