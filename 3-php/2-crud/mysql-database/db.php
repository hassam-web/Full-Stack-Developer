<?php
//localhost/username/password/database-name

$connection = mysqli_connect('localhost', 'root', '', 'hassam-web');
if ($connection) {
    // echo 'database is connected';
} else {
    die('database connection failed');
}