<?php

declare(strict_types=1);

require_once 'inc/class-utilities.php';

session_start();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

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
        $failed_to_login_email = $email;
    }
}
?>


<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Login</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <?php if (isset($failed_to_login_email)) { ?>
            <div class="alert alert-danger" role="alert">
                Invalid e-mail/password.
            </div>
        <?php } ?>

        <form method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value=<?= $failed_to_login_email ?? '' ?>>
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