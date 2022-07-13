<?php 
/**
 *
 * GET USER ID
 *
 */

$user_id = $_GET['user_id'] ?? 0;

/**
 *
 * USER GET QUERY FROM USER ID
 *
 */

$edit_user_query = "SELECT * from users where user_id = '$user_id'";
$result = confirmQuery($edit_user_query);

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
        $token = $row['token'];

    }
}

/**
 *
 * USER UPDATE POST REQUEST
 *
 */


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_user'])) {
        $user_name = $_POST['user_name'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_image = $_POST['user_image'];
        $user_email = $_POST['user_email'];
        $role = $_POST['role'];
        $user_password = $_POST['user_password'];

        $update_user_query = "UPDATE users SET ";
        $update_user_query .= "username = '{$user_name}',";
        $update_user_query .= "user_firstname = '{$user_firstname}',";
        $update_user_query .= "user_lastname = '{$user_lastname}',";
        
        $update_user_query .= "user_email = '{$user_email}',";
        
        if (isset($user_password)) {
            $user_password_new =  password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
            $update_user_query .= "user_password = '{$user_password_new}',";
        }

        $user_image = null;
        $user_image_new = null;

        if (isset($_FILES['user_image'])) {
         //file uploading code start
         $user_image = $_FILES['user_image']['name'];
         $user_image_temp = $_FILES['user_image']['tmp_name'];
         move_uploaded_file($user_image_temp, "../uploads/users/$user_image" );
         //file uploading code end
         $user_image_new = '/uploads/users/'.$user_image; 
        }

        if ($user_image && $user_image_new) {
            $update_user_query .= "user_image = '{$user_image_new}',";
        }


        $update_user_query .= "user_role = '{$role}'";
        $update_user_query .= " WHERE user_id = '{$user_id}'";

        $result = confirmQuery($update_user_query);

        redirect("/admin/users.php");
    }
}
 ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Edit User
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/users.php" class="btn btn-primary">Back</a>

        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=edit_user&user_id=<?php echo $user_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" id="" placeholder="User Name" name="user_name" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="" placeholder="First Name" name="user_firstname" value="<?php echo $user_firstname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="" placeholder="Last Name" name="user_lastname" value="<?php echo $user_lastname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">User Image</label>
                            <input type="file" name="user_image">
                        </div>
                        <?php if ($user_image): ?>
                            <img src="<?php echo $user_image; ?>" alt="" width="80">
                            <br> <br>
                        <?php endif ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="" placeholder="Email" name="user_email" value="<?php echo $user_email; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="input" class="form-control" required="required">
                            <option value="">Select Role</option>
                            <option value="subscriber" <?php echo $user_role == 'subscriber' ? 'selected' : ''; ?>>Subscriber</option>
                            <option value="admin" <?php echo $user_role == 'subscriber' ? 'admin' : ''; ?>>Admin</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="" placeholder="Password" name="user_password">
                    </div>
                       
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="update_user">Submit</button>
        </form>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->