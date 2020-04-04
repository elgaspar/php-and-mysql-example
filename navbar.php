<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">PHP and MySQL Example</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto">

        </div>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
            <a class="btn btn-primary" href="logout.php" role="button">Log out</a>
        <?php } ?>

    </div>
</nav>