<?php include "includes/admin_header.php"; ?>
    <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<?php 

 ?>
<?php 

$source = '';
if (isset($_GET['source'])) {
    $source = $_GET['source'];
}



switch ($source) {
    case 'add_post':
        include "includes/posts/create.php";
        break;
    case 'edit_post':
        include "includes/posts/edit.php";
        break;
    default:
        include "includes/posts/index.php";
        break;
}

 ?>

<?php include "includes/admin_footer.php"; ?>