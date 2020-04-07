<?php

declare(strict_types=1);

require_once 'inc/class-utilities.php';
require_once 'inc/class-session.php';

$session = new Session();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = Utilities::user_login($email, $password);
    if ($user) {
        $session->set_logged_in_user($user);

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