<?php
    include('partials/menu.php') ;
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br />
        <br />

        <?php
            ///Succesfull deleting .
            if (isset($_SESSION['delete-category'])) {
                echo $_SESSION['delete-category'] ;
                unset($_SESSION['delete-category']); 
            }
            ///issue when remove photo .
            if (isset($_SESSION['not-remove-photo'])){
                echo $_SESSION['not-remove-photo'] ;
                unset($_SESSION['not-remove-photo']) ;
            }
            ///prevent to access without chossing category .
            if (isset($_SESSION['no-category-choosen'])) {
                echo $_SESSION['no-category-choosen'];
                unset($_SESSION['no-category-choosen']);
            }
            ///trying to id random id so we prevent that.
            if (isset($_SESSION['category-not-found'])) {
                echo $_SESSION['category-not-found']  ;
                unset($_SESSION['category-not-found']) ;
            }
            ///update category successfully.
            if (isset($_SESSION['success-update-category'])) {
                echo $_SESSION['success-update-category'] ;
                unset($_SESSION['success-update-category']) ;
            }
            ///fail to update category.
            if (isset($_SESSION['fail-update-category'])) {
                echo $_SESSION['fail-update-category'] ;
                unset($_SESSION['fail-update-category']) ;
            }
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'] ;
                unset($_SESSION['add']) ;
            } 
        ?>

        <br>
        <!-- Button to ADD Admin -->
        <a href="<?php echo SITEURL ?>admin/add-category.php" class = "btn-primary">Add Category</a>
        <br />
        <br />
        <table class= "tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php 
                $query = "SELECT * FROM tbl_category" ;
                $go = mysqli_query($connect , $query) ;
                $count = mysqli_num_rows($go) ;
                $id = 1 ;
                if ($count >= 1) {
                    while($row = mysqli_fetch_assoc($go)) {
                        $real_id = $row['id'] ;
                        $title = $row['title'] ;
                        $image_name = $row['image_name'] ;
                        $feature = $row['featured'] ;
                        $active = $row['active'] ;
                    
            ?>

                    <tr>
                        <td> <?php echo $id++ ?> </td>
                        <td> <?php echo $title ; ?></td>

                        <td> 
                            <img src = "<?php echo SITEURL; ?>images/category/<?php echo $image_name ;?>" width="100px">
                        </td>

                        <td> <?php echo $feature; ?> </td>
                        <td> <?php echo $active ; ?> </td>
                        <td>
                            <a href="<?php echo SITEURL;?>/admin/update-category.php?id=<?php echo $real_id; ?>" class = "btn-secondry">Update Category</a>
                            <a href="<?php echo SITEURL;?>/admin/delete-category.php?id=<?php echo $real_id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger">Delete Category</a>
                        </td>
                    </tr>

            <?php 
                    }   
                } else {
            ?>

                <tr>
                    <td ><div class = "error">No Category Added</div></td>
                <tr>

            <?php
                }
            ?>

        </table>


    </div>
</div>


<?php 
    include('partials/footer.php') ;
?>