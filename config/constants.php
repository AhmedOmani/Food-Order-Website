<?php

    ///start the session 
    session_start() ;

    ///Create Constants to Store non Reapitng variables
    define('SITEURL' , 'http://localhost/EscapeFromEgypt/FoodOrder/') ;
    define('LOCALHOST' , 'localhost') ;
    define('DB_USERNAME' , 'root') ;
    define('DB_PASSWORD' , '') ;
    define('DB_NAME' , 'food-order') ;

    $connect = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD) or die();
    $db_select = mysqli_select_db($connect , DB_NAME) or die();
?>
