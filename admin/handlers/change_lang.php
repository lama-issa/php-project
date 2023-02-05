
<?php
    session_start();
    if(isset($_GET['lang'])){
        // $_SESSION['lang'] = $_GET['lang'];
        if($_GET['lang'] == 'ar'){
            $_SESSION['lang'] = 'ar';
        }else{
            $_SESSION['lang'] = 'en';
        }
    }else{
        $_SESSION['lang'] = 'en';
    }

    header("location:".$_SERVER['HTTP_REFERER']);

    echo $_SESSION['lang'];
?>