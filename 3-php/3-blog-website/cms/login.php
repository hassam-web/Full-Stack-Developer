<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        ?>
        <div class="container">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Username Field is required</strong>
            </div>
        </div>
        <?php
    }

    if (empty($pasword)) {
        ?>
        <div class="container">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Password Field is required</strong>
            </div>
        </div>
        <?php
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $check_login = login_user($username,$password);

    if ($check_login) {
        redirect("/admin/index.php");
    }else{
        redirect("/login.php");
    }

}


 ?>

<div class="container">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-user fa-4x"></i></h3>
                            <h2 class="text-center">Login</h2>
                            <div class="panel-body">
                                <form id="login-form" role="form" autocomplete="off" class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit"> -->
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                            </div><!-- Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>