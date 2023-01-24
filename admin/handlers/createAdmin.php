<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');
    extract($_POST);
    
    $name = handleStringInputs($name);
    $email = handleStringInputs($email);
    $password = handleStringInputs($password);


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

    // password
    if(empty($password)){
        $errors[]='password is required';
    }elseif (strlen($password) <= '8') {
        $errors[] = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }


    // image
    if($_FILES['image']['name']){
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';
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
        $newName ='default.png';
    }





    echo '<pre>';
    print_r($errors);
    echo '</pre>';

    if(empty($errors)){
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `admins`(`name`,`email`,`password`,`image`) VALUES ('$name' , '$email', '$password' , '$newName')";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName , "../upload/$newName" );
            }

            $_SESSION['success'] = "Admin Created Successfully";
            header('location: ../admins.php');
            
        }else{
            header('location: ../add-admin.php');

            echo "not ok";
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-admin.php');
        echo "Something went wrong";
    }
?>