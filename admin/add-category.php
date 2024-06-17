<?php include('partials/menu.php') ; ?>


<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Category</h1>

        <br><br>
        <?php 
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'] ;
                unset($_SESSION['add']) ;
            } 
            if (isset($_SESSION['upload-image'])) {
                echo $_SESSION['upload-image'] ;
                unset($_SESSION['upload-image']) ;
            }
        ?>
        <br>
        
        <!--Form ADD Category Starts-->
        <form method = "POST" enctype="multipart/form-data">

            <table class = "tbl-30">
                <tr>
                    <td>Title:</td>
                    <td> <input type = "text" name = "title" placeholder="Category Title"> </td>
                </tr>
                
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type ="file" name = "image" required>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td> 
                        <input type = "radio" name = "featured" value="YES">YES
                        <input type = "radio" name = "featured" value="NO">NO
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td> 
                        <input type = "radio" name = "Active" value="YES">YES
                        <input type = "radio" name = "Active" value="NO">NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type = "submit" name = "submit" value = "Add Category" class = "btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
        <!--Form ADD Category Ends-->

        <?php

            if (isset($_POST['submit'])) {
                
                //GET data from POST .
                $title = $_POST['title'] ;
                
                if (isset($_POST['featured']))
                    $feature = $_POST['featured'] ;
                else
                    $feature  = "NO" ;

                if (isset($_POST['Active'])) 
                    $active = $_POST['Active'] ;
                else
                    $active = "NO" ;
                

                ///1. upload photo
                $image_name = $_FILES['image']['name'] ;
                ///2. rename the image to avoid replace the same image
                $ext = end(explode('.' , $image_name)) ;
                $image_name = "Food_Category_".rand(0 , 1000).rand(0 , 1000).rand(0 , 1000).'.'.$ext ;
                $image_path = $_FILES['image']['tmp_name'] ;
                $image_destination = "../images/category/".$image_name ;
                ///3. move file ;
                $upload = move_uploaded_file($image_path , $image_destination) ;

                ///check if it is uploaded or not 
                if ($upload == false) {
                    $_SESSION['upload-image'] = "<div class = 'error'>Failed to upload image , Try Again.</div>";
                    header('location:'.SITEURL.'admin/add-category.php') ;
                    die() ;
                }
                
                $query = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$feature',
                active = '$active'
                ";

                $go = mysqli_query($connect , $query) ;

                if ($go == true) {
                    $_SESSION['add'] = "<div class = 'success'> Category Added Succesfully. </div>" ;
                    header('location:'.SITEURL.'admin/manage-category.php') ;
                } else {
                    $_SESSION['add'] = "<div class = 'success'> Failed To Add Category. </div>" ;
                    header('location:'.SITEURL.'admin/add-category.php') ;
                }
                
            }

        ?>
    </div>
</div>




<?php include('partials/footer.php') ; ?>