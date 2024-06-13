<?php
    include('partials/menu.php') ;
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br />
        <br />

        <?php 
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
                            <a href="#" class = "btn-secondry">Update Category</a>
                            <a href="#" class = "btn-danger">Delete Category</a>
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