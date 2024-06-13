<?php include('partials/menu.php') ; ?>

<div class = "main-content">
    <div class = "wrapper">
        
        <h1>Update Category</h1>

        <br><br>
        
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'] ;
                $query = "SELECT * FROM tbl_category WHERE id = $id" ;
                $go = mysqli_query($connect , $query) ;
                $count = mysqli_num_rows($go) ;
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($go) ;
                } else {
                    $_SESSION['category-not-found'] = "<div class = 'error'> Category Not Found. </div>" ;
                    header('location:'.SITEURL.'admin/manage-category.php') ;
                }
            } else {
                header('location:'.SITEURL.'admin/manage-category.php') ;
            }
        ?>

        <!--Form ADD Category Starts-->
        <form method = "POST" enctype="multipart/form-data">

            <table class = "tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type = "text" name = "title" value = "<?php echo $row['title'] ?>"> </td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <img src = "<?php echo SITEURL?>images/category/<?php echo $row['image_name'] ; ?> " width="100px">
                    </td>
                </tr>

                <tr>
                    <td>New image</td>
                    <td> <input type = "file" name = "image" required> </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td> 
                        <input <?php if ($row['featured'] == "YES"){echo "checked";} ?> type = "radio" name = "featured" value="YES">YES
                        <input <?php if ($row['featured'] == "NO") {echo "checked";}?> type = "radio" name = "featured" value="NO">NO
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td> 
                        <input <?php if ($row['active'] == "YES"){echo "checked";} ?> type = "radio" name = "active" value="YES">YES
                        <input <?php if ($row['active'] == "NO"){echo "checked";} ?> type = "radio" name = "active" value="NO">NO
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type = "hidden" name = "current_image" value = <?php echo $row['image_name'] ;?>>
                        <input type = "hidden" name = "id" value = <?php echo $row['id'] ;?>>
                        <input type = "submit" name = "submit" value = "Update Category" class = "btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
        <!--Form ADD Category Ends-->

        <?php

            if (isset($_POST['submit'])) {
                $id = $_POST['id'] ;
                $title = $_POST['title'] ;
                $current_image = $_POST['current_image'] ;
                $feature = $_POST['featured'] ;
                $active = $_POST['active'] ;
       

                ///1. upload photo
                $image_name = $_FILES['image']['name'] ;
                ///2. rename the image to avoid replace the same image
                $ext = end(explode('.' , $image_name)) ;
                $image_name = "Food_Category_".rand(0 , 1000).rand(0 , 1000).rand(0 , 1000).'.'.$ext ;
                $image_path = $_FILES['image']['tmp_name'] ;
                $image_destination = "../images/category/".$image_name ;
                ///3. move file ;
                $upload = move_uploaded_file($image_path , $image_destination) ;
                
                ///4.delete old photo
                $path = "../images/category/".$current_image;
                $remove_photo = unlink($path) ;
                
                ///build & excute the query
                $query = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$feature',
                    active = '$active' 
                    WHERE id = $id
                ";

                $go = mysqli_query($connect , $query) ;
                if ($go) {
                    $_SESSION['success-update-category'] = "<div class = 'success'>Category Updated Succesfully.</div>" ;
                    header('location:'.SITEURL.'admin/manage-category.php') ;
                } else {
                    $_SESSION['fail-update-category'] = "<div class = 'error'>Something went wrong , Try again.</div>" ;
                    header('location:'.SITEURL.'admin/manage-category.php') ;
                } 
            }
        
        ?>

    </div>
</div>


<?php include('partials/footer.php') ; ?>