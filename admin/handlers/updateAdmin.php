<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');

    extract($_POST);
    
    $name = handleStringInputs($name);
    $email = handleStringInputs($email);

    $sql = "SELECT * FROM  `admins` where `id` = $admin_id";
    $query = mysqli_query($conn , $sql);
    $admin = mysqli_fetch_assoc($query);
    $oldImage = $admin['image'];

    $errors = [];

    // name
    if(empty($name)){
        $errors[]='name is required';
    }elseif(!is_string($name)){
        $errors[]='name must be a string';
    }elseif( strlen($name) <=2 || strlen($name) > 40 ){
        $errors[]='name must be between 2 - 40 chars';
    }

    // email
    if(empty($email)){
        $errors[]='email is required';
    }elseif( !filter_var($email , FILTER_VALIDATE_EMAIL) ){
        $errors[]='email is not valid';
    }elseif( strlen($email) <=8 || strlen($email) > 60 ){
        $errors[]='email size error';
    }

    // image
    if($_FILES['image']['name']){
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $tmpName = $img['tmp_name'];
        $sizeMb = $img['size']/(1024*1024);

        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        $newName = uniqid().$name.'.'.$ext;

        if($sizeMb > 5){
            $errors[] = "image must be less than 5mb";
        }
    }else{
        $newName = $oldImage;
    }





    // echo '<pre>';
    // print_r($errors);
    // echo '</pre>';

    if(empty($errors)){
        $sql = "UPDATE `admins` set `name`='$name' , `email`='$email' , `is_active`= $is_active , `image` = '$newName'";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName , "../upload/$newName" );
                if($oldImage != 'default.png'){
                    unlink("../upload/$oldImage");
                }
            }

            $_SESSION['success'] = "Admin updated Successfully";
            header('location: ../admins.php');
            
        }else{
            $_SESSION['errors'] = ['Something went wrong'];

            header('location: ../add-admin.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-admin.php');
    }
?>