<?php 
session_start();
require('../includes/connection.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `admins` where `id` = $id";
    $query = mysqli_query($conn , $sql);
    if(mysqli_num_rows($query) > 0 ){
        $admin = mysqli_fetch_assoc($query);
        $image = $admin['image'];
        $sql ="DELETE FROM `admins` where `id`=$id";
        
        if(mysqli_query($conn , $sql)){
            if($image != "default.png"){
                unlink("../upload/$image");
            }
            $_SESSION['success'] = "Admin deleted Successfully";
            header('location: ../admins.php');
        }
    }else{
        $_SESSION['errors'] = ['no admin found'];
        header('location: ../admins.php');
    }
}