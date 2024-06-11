<?php
    include('partials/menu.php') ;
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <!-- Button to ADD Admin -->

        <br />
        <br />
        <table class= "tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Full name</th>
                <th>User Name</th>
                <th>Action</th>

            </tr>
            <tr>
                <td>1. </td>
                <td>Ahmed Saber</td>
                <td>Omani</td>
                <td>
                    <a href="#" class = "btn-secondry">Update Admin</a>
                    <a href="#" class = "btn-danger">Delete Admin</a>
                </td>
            </tr>
            

        </table>

    </div>
</div>


<?php 
    include('partials/footer.php') ;
?>