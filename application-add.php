<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['reason'])) {
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $reason = $_POST['reason'];
    $user_id = $_SESSION['id'];
    $user_full_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];

    require_once 'db-connect.php';

    $results = $db_connection->prepare("INSERT INTO applications (vacation_start, vacation_end, reason, user_id) VALUES (?, ?, ?, ?)");
    $results->bind_param("sssi", $date_from, $date_to, $reason, $user_id);
    $results->execute();
    $results->close();

    //TODO: send e-mail to administrator for approving/rejection

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

            <a class="btn btn-secondary" href="applications.php" role="button" style="width: 100px;">Back</a>

            <button type="submit" class="btn btn-primary float-right w-10" style="width: 100px;">Submit</button>

        </form>

    </div>
</div>

<?php include 'template-end.php'; ?>