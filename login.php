<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container p-3">

        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">

                <h3 class="text-center mb-5">Login</h3>

                <form action="authenticate.php" method="post">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required="required">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

            </div>
        </div>

    </div>
</body>

</html>