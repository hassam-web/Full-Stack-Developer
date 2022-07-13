<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_user'])) {
        $user_name = $_POST['user_name'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $role = $_POST['role'];
        $user_password = $_POST['user_password'];
        $create_user = $_POST['create_user'];

        $user_password_new =  password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

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


        $insert_user_query = "INSERT INTO users (username,user_firstname,user_lastname,user_image,user_email,user_role,user_password) VALUES ('$user_name','$user_firstname','$user_lastname','$user_image_new','$user_email','$role','$user_password_new')";
        $result = confirmQuery($insert_user_query);

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
                   Add User
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/users.php" class="btn btn-primary">Back</a>

        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=add_user" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" id="" placeholder="User Name" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="" placeholder="First Name" name="user_firstname">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="" placeholder="Last Name" name="user_lastname">
                        </div>

                        <div class="form-group">
                            <label for="">User Image</label>
                            <input type="file" name="user_image">
                        </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="" placeholder="Email" name="user_email">
                    </div>

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="input" class="form-control" required="required">
                            <option value="">Select Role</option>
                            <option value="subscriber">Subscriber</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="" placeholder="Password" name="user_password">
                    </div>
                       
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="create_user">Submit</button>
        </form>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->