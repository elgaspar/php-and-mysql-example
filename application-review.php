<?php

declare(strict_types=1);

require_once 'inc/class-utilities.php';


if (isset($_GET['id']) && isset($_GET['approve']) && isset($_GET['token'])) {
    $application_id = (int) $_GET['id'];
    $approve = $_GET['approve'] ? true : false;
    $token = $_GET['token'];

    $error_msg = Utilities::review_application($application_id, $approve, $token);
    if (!$error_msg) {
        $success_msg = "Application was " . ($approve ? 'approved' : 'rejected') . ". Employee will be notified by e-mail.";
    }
} else {
    $error_msg = 'Invalid URL.';
}
?>


<?php include 'template-start.php'; ?>

<h3 class="text-center mb-4">Application Approval/Rejection</h3>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4">

        <div class="alert alert-<?= isset($error_msg) ? 'danger' : 'success' ?>" role="alert">
            <?= isset($error_msg) ? $error_msg : $success_msg ?>
        </div>

    </div>
</div>

<?php include 'template-end.php'; ?>