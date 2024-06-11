<?php
    if(!isset($_SESSION['user-online'])) {
        $_SESSION['login-first'] = "<div class = 'error'> Please Login to access Admin Panel </div>";
        header('location:'.SITEURL.'admin/login.php') ;
    }
?>