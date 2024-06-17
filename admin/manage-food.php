<?php
    include('partials/menu.php') ;
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />
        <br />
        <!-- Button to ADD Admin -->
        <a href="add-food.php" class = "btn-primary">Add Food</a>
        <br />
        <br />

        <?php
            if(isset($_SESSION['add-food'])) {
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
            if (isset($_SESSION['not-remove-food-photo'])) {
                echo $_SESSION['not-remove-food-photo'];
                unset($_SESSION['not-remove-food-photo']);
            }
            if (isset($_SESSION['delete-food-success'])) {
                echo $_SESSION['delete-food-success'];
                unset($_SESSION['delete-food-success']);
            }
            if (isset($_SESSION['no-food-chosen'])) {
                echo $_SESSION['no-food-chosen'];
                unset($_SESSION['no-food-chosen']);
            }
        ?>

        <table class= "tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Food</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <tr>

            <?php 
                $query = "SELECT * FROM tbl_food" ;
                $go = mysqli_query($connect , $query) ;
                $count = mysqli_num_rows($go) ;
                $id = 1 ;
                if ($count >= 1) {
                    while($row = mysqli_fetch_assoc($go)) {
                        $real_id = $row['id'] ;
                        $title = $row['food'] ;
                        $price = $row['price'] ;
                        $image_name = $row['image_name'] ;
                        $feature = $row['featured'] ;
                        $active = $row['active'] ;
                    
            ?>

                    <tr>
                        <td> <?php echo $id++."." ; ?> </td>
                        <td> <?php echo $title ; ?></td>
                        <td> <?php echo $price ; ?> </td>
                        <td> 
                            <img src = "<?php echo SITEURL; ?>images/food/<?php echo $image_name ;?>" width="85px">
                        </td>

                        <td> <?php echo $feature; ?> </td>
                        <td> <?php echo $active ; ?> </td>
                        <td>
                            <a href="<?php echo SITEURL;?>/admin/update-food.php?id=<?php echo $real_id; ?>" class = "btn-secondry">Update Food</a>
                            <a href="<?php echo SITEURL;?>/admin/delete-food.php?id=<?php echo $real_id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger">Delete Food</a>
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
                


            </tr>
            

        </table>


    </div>
</div>


<?php
    include('partials/footer.php') ;
?>