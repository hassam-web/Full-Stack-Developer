<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_post'])) {
        
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_date = $_POST['post_date'];
        // $post_image = $_POST['post_image'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_comment_count = 0;


        $post_image = null;

        if (isset($_FILES['post_image'])) {
         //file uploading code start
         $post_image = $_FILES['post_image']['name'];
         $post_image_temp = $_FILES['post_image']['tmp_name'];
         move_uploaded_file($post_image_temp, "../uploads/posts/$post_image" );
         //file uploading code end
        }

        $post_image_new = '/uploads/posts/'.$post_image; 

        $post_insert_query = "INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status,post_comment_count) VALUES ('$post_category_id','$post_title','$post_author','$post_date','$post_image_new','$post_content','$post_tags','$post_status','$post_comment_count')";

        $result = mysqli_query($connection,$post_insert_query);
        if (!$result) {
            die("Query Failed " . mysqli_error($connection));
        }

        header("Location:/admin/posts.php");

        // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
        // VALUES ('John', 'Doe', 'john@example.com');";
    }
}

 ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Add Post
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/posts.php" class="btn btn-primary">Back</a>

        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=add_post" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Post Title</label>
                            <input type="text" class="form-control" id="" placeholder="Post Title" name="post_title">
                        </div>

                        <div class="form-group">
                            <label for="">Post Category</label>
                            <select name="post_category_id" id="input" class="form-control" >
                                <option value="">Select Category</option>
                                <?php 
                                $categories_query = "SELECT * FROM categories";
                                $categories_result = mysqli_query($connection,$categories_query);
                                if (!$categories_result) {
                                    die("Query Failed" . mysqli_error($connection));
                                }
                                 ?>
                                 <?php if ($categories_result->num_rows > 0): ?>
                                 <?php while($row = mysqli_fetch_assoc($categories_result)){ ?>
                                    <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>
                                 <?php } ?>
                                 <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Post Author</label>
                            <input type="text" class="form-control" id="" placeholder="Post Author" name="post_author">
                        </div>

                        <div class="form-group">
                            <label for="">Post Date</label>
                            <input type="date" class="form-control" id="" placeholder="Post Date" name="post_date">
                        </div>

                        <div class="form-group">
                            <label for="">Post Image</label>
                            <input type="file" name="post_image">
                        </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    

                        <div class="form-group">
                            <label for="">Post Content</label>
                            <textarea name="post_content" id="input" class="form-control" rows="3" required="required"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Post Tags</label>
                            <input type="text" class="form-control" id="" placeholder="Post Tags" name="post_tags">
                        </div>
                        <div class="form-group">
                            <label for="">Post Status</label>
                            <select name="post_status" id="input" class="form-control" required="required">
                                <option value="">Post Status</option>
                                <option value="draft">Draft</option>
                                <option value="publish">Publish</option>
                            </select>
                        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="create_post">Submit</button>
        </form>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->