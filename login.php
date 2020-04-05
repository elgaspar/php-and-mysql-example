<?php

declare(strict_types=1);

session_start();
?>

<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Login</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <?php if (isset($_SESSION['login_error'])) { ?>
            <div class="alert alert-danger" role="alert">
                Invalid e-mail/password.
            </div>
        <?php } ?>

        <form action="authenticate.php" method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value=<?= $_SESSION["login_error_email"] ?? '' ?>>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

    </div>
</div>

<?php include 'template-end.php'; ?>


<?php
unset($_SESSION["login_error_email"]);
unset($_SESSION["login_error"]);
