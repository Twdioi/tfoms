<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "task_tfoms";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn){
    die("Connection lost " . mysqli_connect_error());
}
$conn->set_charset('utf8');
