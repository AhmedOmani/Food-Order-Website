<?php include('partials/menu.php') ?>

<?php
    $query = "SELECT title , id FROM tbl_category WHERE active = 'YES' " ;
    $go = mysqli_query($connect , $query) ;
?>

<div class="main-content">
    <div class = "wrapper">
        <h1>Add Food</h1>
        <br><br>
        <form method = "POST" enctype="multipart/form-data">

            <table class = "tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type = "text" name = "title" placeholder = "Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name = "description" cols = "25" rows = "5" placeholder = "Write a description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type = "number" name = "price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name = "image" required></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name = "Category">
                            <?php
                                ///pick all categories you have in tbl_admin from database
                                while($row = mysqli_fetch_assoc($go)) {
                            ?>
                                <option value="<?= $row['id']?>"><?= $row['title'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
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
                        <input type = "submit" name = "submit" value = "Add Food" class = "btn-secondry">
                    </td>
                </tr>


            </table>

        </form>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {
        
        $title = $_POST['title'] ;
        $description = $_POST['description'] ;
        $price = $_POST['price'] ;
        $image_name = $_FILES['image']['name'] ;
        $category_id = $_POST['Category'] ;
        $featured = $_POST['featured'] ;
        $active = $_POST['Active'] ;

        ///Begin of uploading image
        $ext = end(explode('.' , $image_name)) ;
        $image_name = "Food_Category_".rand(0 , 1000).rand(0 , 1000).rand(0 , 1000).'.'.$ext ;
        $image_path = $_FILES['image']['tmp_name'] ;
        $image_destination = "../images/food/".$image_name ;
        $upload = move_uploaded_file($image_path , $image_destination) ;
        ///End of uploading image

        $query2 = "INSERT INTO tbl_food SET
                   food = '$title',
                   description = '$description',
                   price = $price,
                   image_name = '$image_name',
                   category_id = $category_id,
                   featured = '$featured',
                   active = '$active'";

        $go = mysqli_query($connect , $query2) ;
        
        if ($go) {
            $_SESSION['add-food'] = "<div class = 'success'> Added Food Successfully. </div>" ;
            header('location:'.SITEURL.'admin/manage-food.php') ;
        } else {
            $_SESSION['add-food'] = "<div class = 'error'> Something went wrong , Try Again. </div>" ;
            header('location:'.SITEURL.'admin/manage-food.php') ;
        }
    }
?>

<?php include('partials/footer.php') ?>