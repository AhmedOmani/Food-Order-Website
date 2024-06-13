<?php
    include('../config/constants.php') ;
     
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        //Get data
        $id = $_GET['id'] ;
        $image_name = $_GET['image_name'] ;

        //Remove photo from the file
        $path = "../images/category/".$image_name ;
        $remove_photo = unlink($path) ;

        if ($remove_photo == false) {
            $_SESSION['not-remove-photo'] = "<div calss = 'error'> Failed To Remove Photo. </div>" ;
            header('location:'.SITEURL.'admin/manage-category.php') ;
            die() ;
        }

        //Delete data
        $query = "DELETE FROM tbl_category WHERE id = $id" ;
        $go = mysqli_query($connect , $query) ;

        $_SESSION['delete-category'] = "<div class = 'success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php') ;

    } else {
        $_SESSION['no-category-choosen'] = "<div class = 'error'>No category had been choosen.</div>" ;
        header('location:'.SITEURL.'admin/manage-category.php') ;
    }
?>