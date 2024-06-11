<?php

    include('../config/constants.php') ;

    //1. get id of admin to delete it
    $id = $_GET['id'] ;
    //2. write sql query to delete
    $query = "DELETE FROM `tbl_admin` WHERE id = $id" ;
    
    //3. excute query
    $go = mysqli_query($connect , $query) ;
    
    // deleted
    if ($go)  {
        
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Succesfully.</div>" ;
        header('location:'.SITEURL.'admin/manage-admin.php') ;

    } else {

        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>" ;
        header('location:'.SITEURL.'admin/manage-admin.php') ;

    }
    

    
?>