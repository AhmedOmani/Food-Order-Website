<?php include('partials/menu.php') ; ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Admin</h1>
        <br/>
        <br/>
        <?php    
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'] ; /// Display that there is problem to add admin
                unset($_SESSION['add']);
            }
        ?>
        <form method = "POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td> <input type="text" , name="full_name" placeholder="Enter your name"> </td>
                </tr>
        
                <tr>
                    <td>Username: </td>
                    <td> <input type="text" , name="username" placeholder = "Enter your username"> </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td> <input type="password" , name="password" placeholder="Enter your password"> </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name = "submit" value ="Add admin" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    include('partials/footer.php') ;
?>


<?php
    
    ///Check whether the submit button is clicked or not

    if (isset($_POST['submit'])) {
        
        //1. Get the data from the form
        $fullname = $_POST['full_name'] ;
        $username = $_POST['username'] ;
        $password = md5($_POST['password']) ; // encrypt password with md5 hashing
        
        //2. sql query to save data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$fullname',
            username = '$username',
            password = '$password' 
        ";

        //3. Excute query and save it in database
        $ret = mysqli_query($connect , $sql) ;

        //4.check whether excuted or not 
        if ($ret == true) {

            ///Create a Session variable to display Messege
            $_SESSION['add'] = "Admin Added Successfully" ;
        
            ///Redirect To Manage Admin page
            header("location:".SITEURL.'admin/manage-admin.php') ;

        } else {
            
            ///Create a Session variable to display Messege
            $_SESSION['add'] = "Failed to Add Admin" ;
        
            ///Redirect To Manage Admin page
            header("location:".SITEURL.'admin/add-admin.php') ;
        
        }
    }
?>