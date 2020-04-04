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

    require_once 'db-connect.php';

    $results = $db_connection->prepare("INSERT INTO applications (vacation_start, vacation_end, reason, user_id) VALUES (?, ?, ?, ?)");
    $results->bind_param("sssi", $date_from, $date_to, $reason, $user_id);
    $results->execute();
    $results->close();

    header('Location: applications.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container p-3">

        <h3 class="text-center mb-5">Submit Application</h3>

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

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>

                </form>

            </div>
        </div>
    </div>
</body>

</html>