<?php

declare(strict_types=1);

require_once 'inc/class-session.php';
require_once 'inc/class-database.php';
require_once 'inc/enum-application-status.php';

$session = new Session();


if (!$session->is_logged_in() || !$session->is_employee()) {
    header('Location: index.php');
    exit;
}
?>


<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Applications</h3>
<a class="btn btn-primary mb-2" href="application-form.php" role="button">Submit Application</a>

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
        $user_id = $session->get('id');
        $user_applications = Database::get_applications_of_user($user_id);
        foreach ($user_applications as $application) {
            $status = $application->get_status();
            if ($status == ApplicationStatus::APPROVED) {
                $class = 'table-success';
            } else if ($status == ApplicationStatus::REJECTED) {
                $class = 'table-danger';
            } else {
                $class = '';
            }
            $vacation_start_converted = date('d-m-Y', strtotime($application->get_vacation_start()));
            $vacation_end_converted = date('d-m-Y', strtotime($application->get_vacation_end()));
        ?>

            <tr class="<?= $class ?>">
                <td><?= $application->get_created_on() ?></td>
                <td><?= "{$vacation_start_converted} to {$vacation_end_converted}" ?></td>
                <td><?= ucfirst($status) ?></td>
            </tr>

        <?php } ?>

    </tbody>
</table>

<?php include 'template-end.php'; ?>