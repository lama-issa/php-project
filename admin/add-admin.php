<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require('includes/head.php');
?>

<body>
    <?php
        require('./includes/nav.php')
    ?>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="./handlers/createAdmin.php" method="post" enctype="multipart/form-data">
                            <?php
                                if(isset($_SESSION['errors'])):
                                    foreach($_SESSION['errors'] as $error):?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $error?>
                                        </div>
                                        
                            <?php
                                    endforeach;
                                    
                                    unset($_SESSION['errors']);
                                endif;
                            ?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
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