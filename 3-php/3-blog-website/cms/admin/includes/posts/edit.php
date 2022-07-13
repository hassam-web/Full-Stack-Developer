<?php 

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $post_query = "SELECT * FROM posts where post_id = '$post_id'";
    $result = confirmQuery($post_query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_post'])) {
        $post_id = $_GET['post_id'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_date = $_POST['post_date'];
        // $post_image = $_POST['post_image'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];

        $post_image = null;
        $post_image_new = null;

        if (isset($_FILES['post_image'])) {
         //file uploading code start
         $post_image = $_FILES['post_image']['name'];
         $post_image_temp = $_FILES['post_image']['tmp_name'];
         move_uploaded_file($post_image_temp, "../uploads/posts/$post_image" );
         //file uploading code end
         $post_image_new = '/uploads/posts/'.$post_image;
        }


        $update_query = "UPDATE posts SET ";
        $update_query .= "post_title = '{$post_title}',";
        $update_query .= "post_category_id = '{$post_category_id}',";
        $update_query .= "post_author = '{$post_author}',";
        $update_query .= "post_date = '{$post_date}',";
        $update_query .= "post_image = '{$post_image_new}',";
        $update_query .= "post_content = '{$post_content}',";
        $update_query .= "post_tags = '{$post_tags}',";
        $update_query .= "post_status = '{$post_status}' ";
        $update_query .= "WHERE post_id = '$post_id'";


        $result = confirmQuery($update_query);
        if ($result) {
            redirect("/admin/posts.php?source=edit_post&post_id=" . $post_id );
        }

    }
}

 ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Edit Post
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <a href="/admin/posts.php" class="btn btn-primary">Back</a>

        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=edit_post&post_id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Post Title</label>
                            <input type="text" class="form-control" id="" placeholder="Post Title" name="post_title" value="<?php echo $post_title; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Post Category</label>
                            <select name="post_category_id" id="input" class="form-control" >
                                <option value="">Select Category</option>
                                <?php 
                                $categories_query = "SELECT * FROM categories";
                                $categories_result = confirmQuery($categories_query);
                                 ?>
                                 <?php if ($categories_result->num_rows > 0): ?>
                                 <?php while($row = mysqli_fetch_assoc($categories_result)){ ?>
                                    <option 
                                    value="<?php echo $row['cat_id']; ?>"
                                    <?php echo $post_category_id == $row['cat_id'] ? 'selected' : '' ?>

                                        ><?php echo $row['cat_title']; ?></option>
                                 <?php } ?>
                                 <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Post Author</label>
                            <input type="text" class="form-control" id="" placeholder="Post Author" name="post_author" value="<?php echo $post_author; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Post Date</label>
                            <input type="date" class="form-control" id="" placeholder="Post Date" name="post_date" value="<?php echo $post_date; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Post Image</label>
                            <input type="file" name="post_image">
                        </div>
                        <?php if ($post_image): ?>
                            <img src="<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" width="100">
                            <br><br>
                        <?php endif ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    

                        <div class="form-group">
                            <label for="">Post Content</label>
                            <textarea name="post_content" id="input" class="form-control" rows="3" required="required"><?php echo $post_content; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Post Tags</label>
                            <input type="text" class="form-control" id="" placeholder="Post Tags" name="post_tags" value="<?php echo $post_tags; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Post Status</label>
                            <select name="post_status" id="input" class="form-control" required="required">
                                <option value="">Post Status</option>
                                <option 
                                value="draft" 
                                <?php echo $post_status == 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option 
                                value="publish"
                                <?php echo $post_status == 'publish' ? 'selected' : '' ?>
                                >Publish</option>
                            </select>
                        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="update_post">Submit</button>
        </form>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->