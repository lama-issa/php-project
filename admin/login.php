<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require('includes/head.php');
    if(isset($_SESSION['admin'])){
        header("location: index.php");
    }
?>

<body>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <?php
                    require('includes/alerts.php')
                ?>
                <h3 class="mb-3">Login</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form method="post" action="handlers/login.php">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
    require('includes/scripts.php')
    ?>
</body>

</html>