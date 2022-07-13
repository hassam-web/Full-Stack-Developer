<?php 

function redirect($location){
    header("Location:" . $location);
    exit;
}

function confirmQuery($query)
{
    global $connection;
    // $GLOBALS['connection'];

    $result = mysqli_query($connection,$query);
    if (!$result) {
        die('Query Failed '. mysqli_error($connection));
    }
    return $result;
}

function login_user($username,$password)
{
    global $connection;

    $username = mysqli_real_escape_string($connection, trim($username));
    $password = mysqli_real_escape_string($connection, trim($password));

    $result = confirmQuery("SELECT * FROM users where username = '{$username}'");

    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)){ 
            $user_id = $row['user_id'];
            $username = $row['username'];
            $db_user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];

            if (password_verify($password, $db_user_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                return true;
            }else{
                return false;
            }
        }
    }
}

function isUserLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}
function table_row_count($tableName='posts')
{
    $query = "SELECT * from $tableName";
    $result = confirmQuery($query);
    return $result->num_rows;
}


function userLikedThisPost($post_id){
    $user_id = $_SESSION['user_id'];
    $query ="SELECT * FROM post_user WHERE user_id=" . $user_id . " AND post_id={$post_id}";
    $result = confirmQuery($query);
    return mysqli_num_rows($result) >= 1 ? true : false;
}



function userLikedCount($post_id){
    $user_id = $_SESSION['user_id'];
    $query ="SELECT * FROM post_user WHERE user_id=" . $user_id . " AND post_id={$post_id}";
    $result = confirmQuery($query);
    return mysqli_num_rows($result);
}