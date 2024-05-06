<?php
include("../php/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userID = $_POST['ID'];
    $fullName = $_POST['full-name'];
    $username = $_POST['username'];
    $new_username = $_POST['username']; // Add a variable to store the new username

    // Check if password fields are not empty
    if (!empty($_POST['password']) && !empty($_POST['confirm-pass'])) {
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Update password only if password fields are not empty
        $update_password = ", `password` = '$hashed_password'";
    } else {
        // Don't update password if fields are empty
        $update_password = "";
    }

    // Check if the new username exists in the users table
    $check_username = "SELECT * FROM users WHERE username = '$new_username' AND ID != '$userID'";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        // New username is already taken
        echo "username is already taken.";
        $conn->close();
        exit();
    }

    $sql = "UPDATE users SET `full-name` = '$fullName', username = '$new_username' $update_password WHERE ID = '$userID'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        // Error updating record
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>