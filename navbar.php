<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand mx-auto" href="index.php">PHP and MySQL Example</a>

    <div class="w-100 text-left text-sm-right" id="navbarSupportedContent">
        <div class="mr-auto">

        </div>
        <?php if ($session->is_logged_in()) { ?>
            <div class="mt-3 mt-sm-0">
                <span class="navbar-text mr-3">Welcome, <?= $session->get('first_name') ?>!</span>
                <a class="btn btn-primary float-right" href="logout.php" role="button">Log out</a>
            </div>
        <?php } ?>

    </div>
</nav>