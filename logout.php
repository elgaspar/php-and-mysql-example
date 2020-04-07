<?php

declare(strict_types=1);

require_once 'inc/class-session.php';

$session = new Session();

$session->destroy();

header('Location: index.php');
exit;
