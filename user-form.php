<?php

declare(strict_types=1);

session_start();

require_once 'inc/class-session.php';
require_once 'inc/class-database.php';
require_once 'inc/class-user.php';

if (!Session::is_logged_in() || !Session::is_admin()) {
    header('Location: index.php');
    exit;
}

$user_id = (int) ($_GET['id'] ?? null);
if ($user_id) {
    $user = Database::get_user($user_id);
}

if (
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['user_type'])
) {
    $new_user_data = array(
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'is_admin' => $_POST['user_type'] == 'admin' ? true : false,
    );
    if (isset($_POST['password']) && $_POST['password']) {
        $new_user_data['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    if (isset($user)) {
        $user->set_data_array($new_user_data);
        Database::update_user($user);

        //if admin edits himself we update $_SESSION['is_admin'] in case he selected employee user type
        if ($user->get_id() == $_SESSION['id']) {
            $_SESSION['is_admin'] = $new_user_data['is_admin'];
        }
    } else {
        $user = new User($new_user_data);
        Database::add_user($user);
    }

    header('Location: users.php');
    exit;
}



if (isset($user)) {
    $first_name = $user->get_first_name();
    $last_name = $user->get_last_name();
    $email = $user->get_email();
    $is_admin = $user->is_admin();
}
?>


<?php include 'template-start.php'; ?>


<h3 class="text-center mb-4"><?= isset($user) ? 'Edit' : 'Create' ?> User</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <form method="post" action="user-form.php<?= $user_id ? '?id=' . $user_id : '' ?>">

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required="required" value="<?= $first_name ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required="required" value="<?= $last_name ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required="required" value="<?= $email ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Leave it blank if you don't want to change it.</small>
            </div>

            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select class="form-control" id="user_type" name="user_type">
                    <option <?= isset($is_admin) && !$is_admin ? 'selected' : '' ?> value="employee">Employee</option>
                    <option <?= isset($is_admin) && $is_admin ? 'selected' : '' ?> value="admin">Admin</option>
                </select>
            </div>

            <a class="btn btn-secondary form-button" href="users.php" role="button">Back</a>

            <button type="submit" class="btn btn-primary float-right w-10 form-button">Create</button>

        </form>

    </div>
</div>

<?php include 'template-end.php'; ?>