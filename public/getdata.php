<?php
include("../php/conn.php");

$query = "SELECT * FROM students";

$result = mysqli_query($conn , $query);

$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($students);
?>