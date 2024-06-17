<?php
    include('../config/constants.php') ;
     
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        
        $id = $_GET['id'] ;
        $image_name = $_GET['image_name'] ;

        $path = "../images/food/".$image_name ;
        $delete = unlink($path) ;

        if ($delete == false) {
            $_SESSION['not-remove-food-photo'] = "<div class = 'error'> Something Went Wrong , Try Again. </div>" ;
            header('location:'.SITEURL.'admin/manage-food.php') ;
            die() ;
        }

        $query = "DELETE FROM tbl_food WHERE id = '$id'" ;
        $go = mysqli_query($connect , $query) ;

        $_SESSION['delete-food-success'] = "<div class = 'success'> Food Deleted Successfully. </div>" ;
        header('location:'.SITEURL.'admin/manage-food.php') ;

    } else {
        $_SESSION['no-food-chosen'] = "<div class = 'error'> Choose Oreder To Delete. </div>" ;
        header('location:'.SITEURL.'admin/manage-food.php') ;
    }
?>