<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container p-3">

        <h3 class="text-center mb-5">Login</h3>

        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">

                <?php if (isset($_SESSION['login_error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid e-mail/password.
                    </div>
                <?php }
                unset($_SESSION["login_error"]);
                ?>

                <form action="authenticate.php" method="post">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

            </div>
        </div>

    </div>
</body>

</html>