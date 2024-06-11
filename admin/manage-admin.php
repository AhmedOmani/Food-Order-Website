<?php 
    include('partials/menu.php') ;
?>

    <!-- Main Content section start -->
    <div class = "main-content" >
        <div class = "wrapper"> 
           
            <h1>Manage Admin</h1>
            <br />
            <br />

            <?php 
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'] ; ///Display Session Messege if added Successfully
                    unset($_SESSION['add']) ;///Remove Session Messege
                } 
                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'] ;
                    unset($_SESSION['delete']) ;
                }
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'] ;
                    unset($_SESSION['update']) ;
                }
                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'] ;
                    unset($_SESSION['user-not-found']) ;
                }
                if (isset($_SESSION['pw-not-match'])) {
                    echo $_SESSION['pw-not-match'];
                    unset($_SESSION['pw-not-match']);
                }
                if (isset($_SESSION['user-found'])) {
                    echo $_SESSION['user-found'] ;
                    unset($_SESSION['user-found']) ;
                }
                if (isset($_SESSION['login'])) {
                    echo$_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <br/>
            <br/>
            <br/>
            

            <!-- Button to ADD Admin -->
            <a href="add-admin.php" class = "btn-primary">Add Admin</a>
            <br />
            <br />
            <table class= "tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Full name</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
                <?php

                    //Query to get all admins 
                    $sql = "SELECT * FROM tbl_admin" ;  

                    //excute the query
                    $ret = mysqli_query($connect , $sql);
                    
                    //check if query works 
                    if ($ret == true) {
                        
                        ///count rows to check whether there is data in database or not ;
                        $cnt = mysqli_num_rows($ret) ;
                        
                        if ($cnt > 0) {
                            $id = 0;
                            while($rows = mysqli_fetch_assoc($ret)) {
                                $fullname = $rows['full_name'] ;
                                $username = $rows['username'] ;
                                $id += 1 ;

                ?>
                                
                        <!-- Display data in table -->
                        <tr>
                            <td><?= $id ?> </td>
                            <td><?= $fullname ?></td>
                            <td><?= $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $rows['id']?>" class = "btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php    echo $rows['id'] ?>"class = "btn-secondry">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php    echo $rows['id'] ?>"class = "btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        <!-- End Displaying Data -->

                <?php }}} ?>
                    
            </table>
        </div>
    </div>
    <!-- Main Content End -->

<?php
    include('partials/footer.php') ;
?>