<?php

declare(strict_types=1);

session_start();

require_once 'inc/class-session.php';
require_once 'inc/class-application.php';
require_once 'inc/class-database.php';

if (!Session::is_logged_in() || !Session::is_admin()) {
    header('Location: index.php');
    exit;
}

//TODO: handle submited data here

?>


<?php include 'template-start.php'; ?>


<h3 class="text-center mb-4">Create User</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <form method="post">

            <?php
            //TODO
            ?>

            <a class="btn btn-secondary" href="users.php" role="button" style="width: 100px;">Back</a>

            <button type="submit" class="btn btn-primary float-right w-10" style="width: 100px;">Submit</button>

        </form>

    </div>
</div>

<?php include 'template-end.php'; ?>