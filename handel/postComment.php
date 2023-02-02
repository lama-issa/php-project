<?php
    session_start();
    require('../admin/includes/connection.php');
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_SESSION['userId'];
        $blog_id = $_POST['blog_id'];
        $content = $_POST['content'];


        $sql = "INSERT INTO `comments`(`user_id` , `blog_id` , `content`) VALUES ('$user_id' , '$blog_id' , '$content')";
        if (mysqli_query($conn , $sql)){
            header("location: ".$_SERVER['HTTP_REFERER']);
        }

    }else{
        header("location: ../index.php");
    }
?>