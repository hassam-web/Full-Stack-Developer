<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Posts
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <?php 

                // echo "<pre>";
                // print_r($_GET);
                // echo "</pre>";
                $cat_id = $_GET['cat_id'];


                $post_query = "SELECT * from posts  LEFT JOIN categories on posts.post_category_id = categories.cat_id where post_category_id = $cat_id";
                $result = mysqli_query($connection,$post_query);
                if (!$result) {
                    die('Query Failed '. mysqli_error($connection));
                }
                 ?>
                 <?php if ($result->num_rows > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <?php 
                        // echo "<pre>";
                        // print_r($row);
                        // echo "</pre>";
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
                        $cat_title = $row['cat_title'];
                         ?>
                         <div>
                         <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p class="lead">
                            <?php echo $cat_title; ?>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on August <?php echo date('M d, Y h:i A',strtotime($post_date)) ; ?></p>
                        <hr>
                        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                        </div>
                    <?php } ?>
                 <?php else: ?>   
                    <h4>No Record Found!</h4>
                 <?php endif; ?>
                

                <!-- Second Blog Post -->
                

                <!-- Third Blog Post -->
                

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"; ?>