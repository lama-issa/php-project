<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
    require('includes/connection.php');
    
    $sql = "SELECT * FROM `sliders`";
    $query = mysqli_query($conn ,$sql);
    if( mysqli_num_rows($query) > 0 ){
        $sliders = mysqli_fetch_all($query , MYSQLI_ASSOC);  
    }
?>

<body>

    <?php
        require('./includes/nav.php')
    ?>

    <div class="container-fluid py-5">
        <div class="row">
            <!-- alerts -->
            <?php require('./includes/alerts.php')?>

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All SLiders</h3>
                    <a href="./add-slider.php" class="btn btn-secondary">
                        Add New SLider
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($sliders)):
                        foreach($sliders as $index => $slider): ?>
                        <tr>
                            <th scope="row"><?= $index+1?></th>
                            <td><?=  $slider['heading']?> </td>
                            <td> <?= $slider['description']?> </td>
                            <td>
                                <img src="./upload/sliders/<?= $slider['image']?>" alt="slider" style="width: 120px;" >
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="./update-slider.php?id=<?= $slider['id']?>">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- way 1 delete-->
                                <!-- <form action="handlers/deleteAdmin.php" method="post">
                                    <input type="hidden" name="id" value="<?= $admin['id']?>">
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> -->
                                <!-- way 2 delete-->
                                <a class="btn btn-sm btn-danger" href="handlers/deleteSlider.php?id=<?= $slider['id']?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                        endforeach;
                            endif;
                        ?>
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