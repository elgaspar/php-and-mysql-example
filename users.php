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


<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">User Type</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $user_id = $_SESSION['id'];
        $all_users = Database::get_all_users();
        foreach ($all_users as $user) {
            $onclick = "window.location='user-form.php?id={$user->get_id()}';";
        ?>

            <tr class="user-row" onclick="<?= $onclick ?>">
                <td><?= $user->get_first_name() ?></td>
                <td><?= $user->get_last_name() ?></td>
                <td><?= $user->get_email() ?></td>
                <td><?= ucfirst($user->get_user_type()) ?></td>
            </tr>

        <?php } ?>

    </tbody>
</table>

<?php include 'template-end.php'; ?>