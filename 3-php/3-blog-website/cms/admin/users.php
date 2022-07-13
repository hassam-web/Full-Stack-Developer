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
    case 'add_user':
        include "includes/users/create.php";
        break;
    case 'edit_user':
        include "includes/users/edit.php";
        break;
    default:
        include "includes/users/index.php";
        break;
}

 ?>

<?php include "includes/admin_footer.php"; ?>