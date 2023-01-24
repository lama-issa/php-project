<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require('includes/head.php');
    require('includes/connection.php');
    
    $sql = "SELECT * FROM `admins`";
    $query = mysqli_query($conn ,$sql);
    if( mysqli_num_rows($query) > 0 ){
        $admins = mysqli_fetch_all($query , MYSQLI_ASSOC);  
    }
?>

<body>

    <?php
        require('./includes/nav.php')
    ?>

    <div class="container-fluid py-5">
        <div class="row">
            <?php  
                if(isset($_SESSION['success'])):
            ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['success']?>
            </div>
            <?php
                    unset($_SESSION['success']);
                endif;
            ?>
            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Admins</h3>
                    <a href="./add-admin.php" class="btn btn-secondary">
                        Add New Admin
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($admins as $index => $admin): ?>
                        <tr>
                            <th scope="row"><?= $index+1?></th>
                            <td><?=  $admin['name']?> </td>
                            <td> <?= $admin['email']?> </td>
                            <td>
                                <?php if($admin['is_active']): ?>
                                <i class="fas fa-check-circle text-success"></i>
                                <?php else :?>
                                <i class="fas fa-times-circle text-danger"></i>
                                <?php endif;?>
                            </td>
                            <td> <?= $admin['created_at']?> </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="#">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="#">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php
      require('includes/scripts.php')
    ?>
</body>

</html>