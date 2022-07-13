<?php
include "./mysql-database/db.php";

// echo "<pre>";
// print_r($_GET['cat_id']);
// echo "</pre>";

// echo "<pre>";
// print_r($_SERVER['PHP_SELF']);
// echo "</pre>";

$category_id = $_GET['cat_id'];
$query_edit_category = "SELECT * FROM categories where id = '{$category_id}'";
$result = mysqli_query($connection, $query_edit_category);
if (!$result) {
    die('Query Failed' . mysqli_error($connection));
}

$category_row = $result->fetch_assoc();

// echo "<pre>";
// print_r($category_row['name']);
// echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['category_name'];
    if (empty($name)) {
        echo "Category Name is empty";
    } else {
        $query = "UPDATE categories SET name = '{$name}' WHERE id = $category_id";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query Failed' . mysqli_error($connection));
        }
    }

    // header("location : category_view.php");
    header("location: http://localhost/batch-2-learn-development/PHP/crud/category_view.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Category Create Form</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?cat_id=' . $category_id; ?>">
		<legend>Category Edit Form</legend>

		<div class="form-group">
			<label for="">Category Name</label>
			<input type="text" class="form-control" name="category_name" placeholder="Type Your Category Name" value="<?php echo $category_row['name']; ?>">
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>
</body>
</html>