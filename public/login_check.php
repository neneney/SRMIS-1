<?php
session_start();
include('../php/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashed_pass = $user['password'];
        
        if (password_verify($password, $hashed_pass)) {
 
            $status = $user['status'];
            if ($status == "blocked") {
                echo json_encode(['status' => 'blocked']);
            } else {
                
                $_SESSION['user_id'] = $user['ID']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['full-name'] = $user['full-name'];
                echo json_encode(['status' => 'success']);
            }
        } else {
           
            echo json_encode(['status' => 'incorrect_password']);
        }
    } else {
      
        echo json_encode(['status' => 'user_not_found']);
    }
} else {
   
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
