
<?php 

if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $post_delete_query = "DELETE FROM posts WHERE post_id=$post_id";
    $result = mysqli_query($connection,$post_delete_query);
    if (!$result) {
        die("Query Failed" . mysqli_error($connection));
    }
    header("Location:/admin/posts.php");
    exit;
}

 ?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Posts
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/posts.php?source=add_post" class="btn btn-primary">Add Post</a>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $post_query = "SELECT * FROM posts left join categories on posts.post_category_id = categories.cat_id";
                        $result = mysqli_query($connection,$post_query);
                        if (!$result) {
                            die("Query Failed" . mysqli_error($connection));
                        }
                         ?>
                        <?php if ($result->num_rows > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $row['post_id']; ?></td>
                            <td><?php echo $row['cat_title']; ?></td>
                            <td><?php echo $row['post_title']; ?></td>
                            <td><?php echo $row['post_author']; ?></td>
                            <td><?php echo $row['post_date']; ?></td>
                            <td>
                                <?php if ($row['post_image']): ?>
                                <img src="<?php echo $row['post_image']; ?>" alt="" width="100">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['post_status']; ?></td>
                            <td><a href="/admin/posts.php?source=edit_post&post_id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Edit</a></td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo $_SERVER['PHP_SELF']; ?>?delete=<?php echo $row['post_id']; ?>" onclick="return confirm('Are you sure ?');">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                         <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->