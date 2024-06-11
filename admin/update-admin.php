<?php include('partials/menu.php') ; ?>



<div class = "main-content" >
    <div class = "wrapper">
        <h1>Update Admin</h1>
        
        <br/><br/>

        <?php
            $id = $_GET['id'] ;
            $query = "SELECT * FROM tbl_admin WHERE $id = id" ;
            $go = mysqli_query($connect , $query) ;
            if ($go) {
                
                $data = mysqli_num_rows($go) ;
                
                if ($data == 1) {
                    $row = mysqli_fetch_assoc($go) ;
                    $fullname = $row['full_name'] ;
                    $username = $row['username'] ;

                } else {
                    header('location:'.SITEURL.'admin/manage-admin.php') ;
                }
            } else {

            }
        ?>


        <form action="" method = "POST" >
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name = "full_name" value="<?php echo $fullname ?>"></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name = "username" value="<?php echo $username ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value ="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update admin" class ="btn-secondry">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php
    if (isset($_POST['submit'])) {
        $fullname = $_POST['full_name'];
        $username = $_POST['username'] ;
        $id = $_POST['id'] ;
        
        $query = "UPDATE tbl_admin SET
        full_name = '$fullname',
        username = '$username'
        WHERE id = '$id'" ;

        $go = mysqli_query($connect , $query) ;

        if ($go) {
            
            $_SESSION['update'] = "<div class = 'success'>Admin Added Successfully.</div>" ;
            header('location:'.SITEURL.'admin/manage-admin.php') ;


        } else {

            $_SESSION['update'] = "<div class = 'error'>Error To Adding , Try Again.</div>" ;
            header('location:'.SITEURL.'admin/manage-admin.php') ;

        }
    }
?>

<?php include('partials/footer.php') ; ?>
