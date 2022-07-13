<?php include "includes/admin_header.php"; ?>

<?php include "includes/admin_navigation.php"; ?>

<?php 
/*if (isset($_GET['edit'])) {
    //UPDATE CATEGORY
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $cat_title = $_POST['cat_title'];
        $cat_id = $_GET['edit'];
        $category_update_query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
        $result = mysqli_query($connection, $category_update_query);
        if (!$result) {
            die('QUERY FAILED ' . mysqli_error($connection));
        }
        header("Location:/admin/categories.php");
        exit;
    }
}else{
    //INSERT CATEGORY
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $cat_title = $_POST['cat_title'];
        $category_insert_query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
        $result = mysqli_query($connection, $category_insert_query);
        if (!$result) {
            die('QUERY FAILED ' . mysqli_error($connection));
        }
        header("Location:/admin/categories.php");
        exit;
    }
}*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cat_title = $_POST['cat_title'];
    //Update Query
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        $category_query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
    }
    //Insert Query
    else{
        $category_query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
    }
    $result = mysqli_query($connection, $category_query);
    if (!$result) {
        die('QUERY FAILED ' . mysqli_error($connection));
    }
    header("Location:/admin/categories.php");
    exit;
}


//DELETE WORK
if (isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];
    $category_delete_query = "DELETE FROM categories WHERE cat_id=$cat_id";
    $result = mysqli_query($connection, $category_delete_query);
    if (!$result) {
        die('QUERY FAILED ' . mysqli_error($connection));
    }
    header("Location:/admin/categories.php");
    exit;
}

 ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Category Page
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <?php if (isset($_GET['edit'])): ?>
                            <?php 
                            $cat_id = $_GET['edit'];
                            $category_row_query = "SELECT * FROM categories where cat_id = '$cat_id'";
                            $result = mysqli_query($connection,$category_row_query);
                            if (!$result) {
                                die('QUERY FAILED ' . mysqli_error($connection));
                            }
                            if ($result->num_rows > 0){
                             ?>
                             <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?edit=<?php echo $row['cat_id']; ?>" method="POST" role="form">
                                <div class="form-group">
                                    <label for="">Update Category</label>
                                    <input type="text" class="form-control" placeholder="Category Title" name="cat_title" value="<?php echo $row['cat_title']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <?php 
                                }
                            }
                             ?>
                        <?php else: ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
                                <div class="form-group">
                                    <label for="">Add Category</label>
                                    <input type="text" class="form-control" placeholder="Category Title" name="cat_title">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        <?php endif ?>
                        
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $category_query = "SELECT * FROM categories";
                                $result = mysqli_query($connection,$category_query);
                                if (!$result) {
                                    die('QUERY FAILED ' . mysqli_error($connection));
                                }
                                $count = 1;
                                if ($result->num_rows > 0){
                                 ?>
                                 <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                <?php 
                                // echo "<pre>";
                                // print_r($row);
                                // echo "</pre>";
                                ?>
                                <tr>
                                    <!-- <td><?php echo $row['cat_id']; ?></td> -->
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['cat_title']; ?></td>
                                    <td>
                                        <a href="/admin/categories.php?edit=<?php echo $row['cat_id']; ?>" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="/admin/categories.php?delete=<?php echo $row['cat_id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Delete</a>
                                    </td>
                                </tr>
                                <?php $count++; ?>
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

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>