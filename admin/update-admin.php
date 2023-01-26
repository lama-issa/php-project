<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require('includes/head.php');
    require('./includes/connection.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `admins` where `id` = $id";
        $query = mysqli_query($conn , $sql);
        if(mysqli_num_rows($query) > 0 ){
            $admin = mysqli_fetch_assoc($query);
        }else{
            $_SESSION['errors'] = ['no admin found'];
            header('location: ./admins.php');
        }
    }else{
        $_SESSION['errors'] = ['Something went wrong'];
        header('location: ./admins.php');
    }
?>

<body>
    <?php
        require('./includes/nav.php')
    ?>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Update Admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="./handlers/updateAdmin.php" method="post" enctype="multipart/form-data">
                            <!-- alerts -->
                            <?php require('./includes/alerts.php')?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $admin['name']?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $admin['email']?>">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" <?= $admin['is_active'] == 1 ?'selected' : '' ?> >active</option>
                                    <option value="0" <?= $admin['is_active'] == 0 ?'selected' : '' ?> >not active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="upload/<?= $admin['image']?>" alt="" style="width: 200px; height: 200px; border-radius: 50%;" >
                            </div>
                            <input type="hidden" name="admin_id" value="<?= $admin['id']?>">

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
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