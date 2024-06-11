<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>

    <body>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form method="POST">
            <h3>Login Here</h3>
            <?php
                if (isset($_SESSION['not-login'])) {
                    echo $_SESSION['not-login'] ;
                    unset($_SESSION['not-login']) ;
                }
                if (isset($_SESSION['login-first'])) {
                    echo $_SESSION['login-first'] ;
                    unset($_SESSION['login-first']) ;
                }
            ?>
            <label for="username">Username</label>
            <input type = "text" placeholder ="Email" name = "username" id = "username">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name = "password" id = "password">

            <button name = "submit">Log In</button>
            
        </form>
    </body>
</html>


<?php

    if (isset($_POST['submit'])) {
        $username = $_POST['username'] ;
        $password = md5($_POST['password']) ;
        
        $query = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'"; 
        $go = mysqli_query($connect , $query) ;
        
        if (mysqli_num_rows($go) == 1) {
            $row = mysqli_fetch_assoc($go) ;
            $_SESSION['login'] = "<div class = 'success'>Login Succesful.</div>" ;
            $_SESSION['user-online'] = $row['id'] ;
            header('location:'.SITEURL.'admin/') ;
        } else {
            $_SESSION['not-login'] = "<div class = 'error'>Username or Password maybe not correct.</div>" ;
            header('location:'.SITEURL.'admin/login.php') ;
        }

    }


?>
