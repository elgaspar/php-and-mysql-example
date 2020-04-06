<?php

declare(strict_types=1);

session_start();

require_once 'inc/class-session.php';
require_once 'inc/class-application.php';
require_once 'inc/class-database.php';
require_once 'inc/class-email-for-admin.php';


if (!Session::is_logged_in() || !Session::is_employee()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['reason'])) {
    $new_application_data = array(
        'vacation_start' =>  $_POST['date_from'],
        'vacation_end' => $_POST['date_to'],
        'reason' => $_POST['reason'],
        'user_id' => $_SESSION['id'],
    );

    $application = new Application($new_application_data);
    Database::add_application($application);

    $full_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
    $email = new EmailForAdmin($application, $full_name);
    $email->send();

    header('Location: applications.php');
    exit;
}
?>


<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Submit Application</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <form method="post">

            <div class="form-group">
                <label for="date_from">Date From:</label>
                <input type="date" class="form-control" id="date_from" name="date_from" required="required">
            </div>

            <div class="form-group">
                <label for="date_to">Date To:</label>
                <input type="date" class="form-control" id="date_to" name="date_to" required="required">
            </div>

            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea class="form-control" name="reason" id="reason" rows="3" required="required"></textarea>
            </div>

            <a class="btn btn-secondary form-button" href="applications.php" role="button">Back</a>

            <button type="submit" class="btn btn-primary float-right w-10 form-button">Submit</button>

        </form>

    </div>
</div>

<?php include 'template-end.php'; ?>