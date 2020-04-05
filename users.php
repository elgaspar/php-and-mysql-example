<?php

declare(strict_types=1);

require_once 'inc/class-session.php';
require_once 'inc/class-database.php';

session_start();

if (!Session::is_logged_in() || !Session::is_admin()) {
    header('Location: index.php');
    exit;
}
?>


<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Users</h3>
<a class="btn btn-primary mb-2" href="user-form.php" role="button">Create User</a>


<?php
//TODO
?>


<?php include 'template-end.php'; ?>