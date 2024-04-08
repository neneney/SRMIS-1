<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "stud_rec";

// Check connection
if (!$conn=mysqli_connect($servername, $username, $password, $database)) {
    die("Connection failed: " . $conn->connect_error);
}
?>  