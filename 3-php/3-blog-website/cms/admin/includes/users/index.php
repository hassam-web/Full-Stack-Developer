<?php 
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $user_delete_query = "DELETE FROM users where user_id = '$user_id'";
    $result = confirmQuery($user_delete_query);
    redirect("/admin/users.php");
    exit;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

 ?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Users
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/users.php?source=add_user" class="btn btn-primary">Add User</a>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       $user_query = "SELECT * from users";
                       $result = confirmQuery($user_query);

                       if ($result->num_rows > 0) {
                           
                       
                       while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_password = $row['user_password'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_role = $row['user_role'];
    
                       ?>
                        <tr>
                            <td><?php echo $user_id; ?></td>
                            <td><?php echo $user_firstname; ?></td>
                            <td><?php echo $user_lastname; ?></td>
                            <td><?php echo $user_email; ?></td>
                            <td><img src="<?php echo $user_image; ?>" alt="" width="80"></td>
                            <td><?php echo $user_role; ?></td>
                            <td>
                                <a href="/admin/users.php?source=edit_user&user_id=<?php echo $user_id; ?>" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <?php if ($_SESSION['user_id'] !=  $user_id): ?>
                                    <a href="/admin/users.php?delete=<?php echo $user_id; ?>" class="btn btn-danger">Delete</a>
                                <?php else: ?>
                                    <p style="margin-bottom: 0px;margin-top: 7px;">
                                        Cannot Delete
                                    </p>
                                <?php endif ?>
                            </td>
                        </tr>
                       <?php } ?>
                       <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->