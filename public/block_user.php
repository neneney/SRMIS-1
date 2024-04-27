<?php

include("../php/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userID = $_POST['userID'];

    
    $status_query = "SELECT status FROM users WHERE ID = '$userID'";
    $status_result = $conn->query($status_query);

    if ($status_result->num_rows > 0) {
        $row = $status_result->fetch_assoc();
        $current_status = $row['status'];

        
        $new_status = ($current_status == 'unlocked') ? 'blocked' : 'unlocked';

    
        $update_query = "UPDATE users SET status = '$new_status' WHERE ID = '$userID'";
        if ($conn->query($update_query) === TRUE) {
            
            echo "User status updated successfully";
        } else {
            
            echo "Error updating user status: " . $conn->error;
        }
    } else {
        
        echo "User not found";
    }
} else {
    
    echo "Invalid request method";
}


$conn->close();
?>
