<?php include "includes/admin_header.php"; ?>
    <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>


<?php

    function comment_delete_query($comment_id){
       $delete_comment_query = "DELETE from comments where comment_id = '{$comment_id}'";
       $result = confirmQuery($delete_comment_query); 
       return $result;
    }

    function comment_status_query($comment_id,$comment_status='approved')
    {
       $update_comment_query = "UPDATE comments set comment_status = '$comment_status' where comment_id = '$comment_id'";
       $result = confirmQuery($update_comment_query);
    }
    
    if (isset($_GET['delete'])) {
       $comment_id = $_GET['delete'];
       comment_delete_query($comment_id);
       redirect('/admin/comments.php');
    }

    if (isset($_GET['approved'])) {
       $comment_id = $_GET['approved'];
       comment_status_query($comment_id);
       redirect('/admin/comments.php');
    }

    if (isset($_GET['unapproved'])) {
       $comment_id = $_GET['unapproved'];
       comment_status_query($comment_id,'unapproved');
       redirect('/admin/comments.php');
    }

 ?>



 <?php 

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['submit'])) {
        $bulk_options = $_POST['bulk_options'];
        $checkBoxArray = $_POST['checkBoxArray'];
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // return;
        if (count($checkBoxArray) > 0) {
            foreach ($checkBoxArray as $key => $single_val) {
                $comment_id = $single_val;
                switch ($bulk_options) {
                    case 'approved':
                        comment_status_query($comment_id);
                        break;
                    case 'unapproved':
                        comment_status_query($comment_id,'unapproved');
                        break;
                    case 'delete':
                        comment_delete_query($comment_id);
                        break;
                }
            }
            redirect('/admin/comments.php');
        }
    }
}

  ?>
<style type="text/css">
#bulkOptionContainer {
    padding-left: 0px;
    margin-bottom: 20px;
}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div id="bulkOptionContainer" class="col-xs-4">
                        <select class="form-control" name="bulk_options" id="">
                            <option value="">Select Options</option>
                            <option value="approved">Approve</option>
                            <option value="unapproved">Unapprove</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" name="submit" class="btn btn-success">Apply</button>
                    </div>
                    <table class="table table-bordered table-hover">
                        <br><br>
                        <thead>
                            <tr>
                                <th><input id="selectAllBoxes" type="checkbox"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query_comments = "SELECT comments.*,posts.post_author,posts.post_title,posts.post_id,users.user_email,users.user_firstname,users.user_lastname from comments LEFT JOIN posts ON comments.post_id = posts.post_id  LEFT JOIN users ON comments.user_id = users.user_id";
                            $result = confirmQuery($query_comments);

                            if ($result->num_rows > 0) {
                                
                            while ($row = mysqli_fetch_assoc($result)) {

                                // echo "<pre>";
                                // print_r($row);
                                // echo "</pre>";

                                $comment_id = $row['comment_id'];
                                $user_id = $row['user_id'];
                                $comment_status = $row['comment_status'];
                                $comment_content = $row['comment_content'];
                                $comment_date = $row['comment_date'];
                                //posts column
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                //users column
                                $user_email = $row['user_email'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                             ?>
                             <tr>
                                <td><input class="rowCheckbox" type="checkbox" name="checkBoxArray[]" value="<?php echo $comment_id; ?>"></td>
                                <td><?php echo $comment_id; ?></td>
                                <td><?php echo $user_firstname; ?> <?php echo $user_lastname; ?></td>
                                <td><?php echo $comment_content; ?></td>
                                <td><?php echo $user_email; ?></td>
                                <td style="color: <?php  echo $comment_status == 'approved' ? 'green' : 'red'; ?>;"><?php echo $comment_status; ?></td>
                                <td><a href="/post.php?post_id=<?php echo $post_id; ?>"> <?php echo $post_title; ?></a></td>
                                <td><?php echo $comment_date; ?></td>
                                <td><a href="/admin/comments.php?approved=<?php echo $comment_id; ?>" >Approved</a></td>
                                <td><a href="/admin/comments.php?unapproved=<?php echo $comment_id; ?>" >UnApproved</a></td>
                                <td><a href="/admin/comments.php?delete=<?php echo $comment_id; ?>" onclick="return confirm('Are you sure ?');">Delete</a></td>
                            </tr>
                             <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?php include "includes/admin_footer.php"; ?>