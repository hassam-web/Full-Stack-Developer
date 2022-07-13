<?php
include "./mysql-database/db.php";

// echo "<pre>";
// print_r($_GET['cat_id']);
// echo "</pre>";

$category_id = $_GET['cat_id'];
$query_edit_category = "DELETE FROM categories where id = '{$category_id}'";
$result = mysqli_query($connection, $query_edit_category);
if (!$result) {
    die('Query Failed' . mysqli_error($connection));
}

header("location: http://localhost/batch-2-learn-development/PHP/crud/category_view.php");