<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: login.php');
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

        <h3 class="text-center mb-5">Applications</h3>
        <a class="btn btn-primary mb-2" href="application-add.php" role="button">Submit Application</a>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Created On</th>
                    <th scope="col">Requested Dates</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $user_id = $_SESSION['id'];

                require_once 'db-connect.php';

                $results = $db_connection->prepare("SELECT created_on, vacation_start, vacation_end, status FROM applications WHERE user_id = ? ORDER BY created_on DESC");
                $results->bind_param("i", $user_id);
                $results->execute();
                $results->store_result();
                $results->bind_result($created_on, $vacation_start, $vacation_end, $status);

                while ($results->fetch()) {
                    if ($status == 'approved') {
                        $class = 'table-success';
                    } else if ($status == 'rejected') {
                        $class = 'table-danger';
                    } else {
                        $class = '';
                    }
                    $vacation_start_converted = date('d-m-Y', strtotime($vacation_start));
                    $vacation_end_converted = date('d-m-Y', strtotime($vacation_end));
                    ?>

                    <tr class="<?= $class ?>">
                        <td><?= $created_on ?></td>
                        <td><?= "{$vacation_start_converted} to {$vacation_end_converted}" ?></td>
                        <td><?= $status ?></td>
                    </tr>

                <?php
                }
                $results->close();
                ?>

            </tbody>
        </table>

    </div>
</body>

</html>