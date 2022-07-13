<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['liked'])) {
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        if (!empty($user_id) && !empty($post_id)) {
            $liked_query = "INSERT INTO post_user (user_id,post_id)";
            $liked_query .= " VALUES ('{$user_id}','{$post_id}')";
            confirmQuery($liked_query);
        }
        // redirect('/post.php?post_id='.$post_id);
        // return json_encode([
        //     'success' => 'user liked successfully'
        // ]);
    }

    if (isset($_POST['unliked'])) {
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        if (!empty($user_id) && !empty($post_id)) {
        $unliked_query = "DELETE from post_user where post_id = '{$post_id}' and user_id = '{$user_id}'";
        confirmQuery($unliked_query);
        }
        // redirect('/post.php?post_id='.$post_id);
        // return json_encode([
        //     'success' => 'user liked successfully'
        // ]);
    }
}


 ?>
<?php 

$post_id = $_GET['post_id'];

// echo "<pre>";
// print_r($post_id);
// echo "</pre>";
$post_detail_query = "SELECT * from posts where post_id = '$post_id'";
$result = mysqli_query($connection,$post_detail_query);

if (!$result) {
    die("query failed " . mysqli_error($connection));
}

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

 ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <!-- <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 
                2013 9:00 PM</p> -->

                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('M d, Y h:i A',strtotime($post_date)) ; ?></p>
                <hr>

                <!-- Preview Image -->
                <?php if ($post_image): ?>
                    <img class="img-responsive" src="<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                <?php else: ?>
                    <img class="img-responsive" src="http://placehold.it/900x300" alt="<?php echo $post_title; ?>">
                <?php endif ?>

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>

                <hr>

                <!-- Blog Comments -->
                <?php if (userLikedThisPost($post_id)): ?>
                    <div class="row">
                        <p class="pull-right">
                            <a
                            class="unlike"
                            href=""
                            data-post-id="<?php echo $post_id; ?>"
                            data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"
                            ><span class="glyphicon glyphicon-thumbs-down"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Want to like it?"
                            ></span>
                                Unlike
                            </a>
                        </p>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <p class="pull-right">
                            <a
                            class="like"
                            href=""
                            data-post-id="<?php echo $post_id; ?>"
                            data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"
                            >
                            <span 
                            class="glyphicon glyphicon-thumbs-up"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="I liked this before"
                            >
                            </span>
                                Like
                            </a>
                        </p>
                    </div>
                <?php endif ?>
                
                <?php if (userLikedCount($post_id) > 0): ?>
                <div class="row">
                        <p class="pull-right likes">Like: <?php echo userLikedCount($post_id); ?></p>
                    </div>
                <?php endif; ?>


                
                <!-- Comments Form -->
                <?php 

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['comment_create'])) {
                        $post_id = $_GET['post_id'];
                        $user_id = $_SESSION['user_id'];
                        $comment_status = 'unapproved';
                        $comment_content = $_POST['comment_content'];
                        $insert_comment_query = "INSERT INTO comments (post_id,user_id,comment_status,comment_content,comment_date)";
                        $insert_comment_query .= " VALUES ('{$post_id}','{$user_id}','{$comment_status}','{$comment_content}',now())";
                        confirmQuery($insert_comment_query);

                        redirect('/post.php?post_id=' . $post_id);
                    }
                }

                 ?>

                 <?php if (isset($_SESSION['user_id'])): ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?post_id=<?php echo $post_id; ?>">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="comment_create">Submit</button>
                    </form>
                </div>
                 <?php endif ?>

                <hr>

                <!-- Posted Comments -->


                <!-- Comment -->
                <?php 
                $comment_query = "SELECT * from comments left join users on comments.user_id = users.user_id  where post_id = $post_id and comment_status = 'approved'";
                $result = confirmQuery($comment_query);
                 ?>
                <?php if ($result->num_rows > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)){ 
                    // echo "<pre>";
                    // print_r($row);
                    // echo "</pre>";

                    $comment_id = $row['comment_id'];
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $comment_status = $row['comment_status'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_image = $row['user_image'];
                    ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <?php if ($user_image): ?>
                        <img class="media-object" src="<?php echo $user_image; ?>" alt="" width="64">
                        <?php else: ?>
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                        <?php endif ?>
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $user_firstname . ' ' . $user_lastname; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php } ?>
                <?php endif; ?>

            </div>
<?php } ?>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"; ?>