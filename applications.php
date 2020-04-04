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

        <?php

        // echo $_SESSION['logged_in'] . '<br>';
        $user_id = $_SESSION['id'] . '<br>';
        // echo $_SESSION['email'] . '<br>';
        // echo $_SESSION['first_name'] . '<br>';
        // echo $_SESSION['last_name'] . '<br>';
        // echo $_SESSION['user_type'] . '<br>';


        require_once 'db-connect.php';

        $results = $db_connection->prepare("SELECT created_on, vacation_start, vacation_end, status FROM applications WHERE user_id = ?");
        $results->bind_param("i", $user_id);
        $results->execute();
        $results->store_result();
        $results->bind_result($created_on, $vacation_start, $vacation_end, $status);

        while ($results->fetch()) {
            echo "{$created_on}<br>{$vacation_start}<br>{$vacation_end}<br>{$status}<br><br>";
        }
        $results->close();





        ?>


    </div>
</body>

</html>