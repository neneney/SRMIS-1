<?php
include("../php/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userID = $_POST['ID'];
    $fullName = $_POST['full-name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = 'unlocked';

    
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        
        echo "Username already taken";
    } else {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (ID, `full-name`, username, , `password`, `status`) VALUES ('$userID', '$fullName', '$username',  '$hashed_password', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "User added successfully";
        } else {
            // Error inserting record
            echo "Error: " . $conn->error;
        }
    }
    $conn->close();
}
?>
