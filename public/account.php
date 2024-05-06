<?php
include("../php/conn.php");
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userID = $_SESSION['user_id'];
    $fullName = $_POST['full-name'];
    $username = $_POST['username'];
    $new_username = $_POST['username']; 
    $currPass = $_POST['c-password'];

    $query = "SELECT * FROM  users WHERE ID = '$userID'";
    $res = mysqli_query($conn, $query);

    if (!empty($_POST['new-password']) && !empty($_POST['conf-password'])) {

        $user = mysqli_fetch_assoc($res);
        $currentPass = $user['password'];

        if(password_verify($currPass, $currentPass)){
            $password = $_POST['new-password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_password = ", `password` = '$hashed_password'";
        }
        else{
            echo "incorrect password";
            exit(); // Terminate script execution if password is incorrect
        }
        
    } else {
        $update_password = "";
    }

    // Check if the new username is already taken
    $check_username = "SELECT * FROM users WHERE username = '$new_username' AND ID != '$userID'";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        echo "Username is already taken.";
        exit(); // Terminate script execution if username is taken
    }

    // Update user information in the database
    $sql = "UPDATE users SET `full-name` = '$fullName', username = '$new_username' $update_password WHERE ID = '$userID'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="../src/account.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../src/navbar.css?v=<?php echo time(); ?>">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/output.css">
    
</head>
<body>
    
<div class="header">
      <div class="left-section">
        <a href="dashboard.php">Bureau of Jail Management and Penology</a>
      </div>
      <div class="right-section">
        <i class="fi fi-rr-sign-out-alt"></i>
        <a href="logout.php" class="logout">Logout</a>
      </div>
    </div>

    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="bx bxl-codepen"></i>
                <span>IskulRec</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <img src="../images/user-image.png" class ="user-img" alt="user">
            <div>
            <p class="user-name"><?php echo $_SESSION['full-name']; ?></p>
            <?php if($_SESSION['user_id'] == 1): ?>
                <p class="admin">Admin</p>
            <?php else: ?>
                <p class="admin">User</p>
            <?php endif; ?>
            
            </div>
            
        </div>
        <ul>
            <li>
                <a href="dashboard.php">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="manage-student.php">
                    <i class="fi fi-rr-users-alt"></i>
                    <span class="nav-item">Students</span>
                </a>
                <span class="tooltip">Students</span>
            </li>
            <?php
            if ($_SESSION['user_id'] == 1) {
                ?>
                <li>
                    <a href="manage-user.php">
                        <i class="fi fi-rr-admin-alt"></i>
                        <span class="nav-item">Users</span>
                    </a>
                    <span class="tooltip">Users</span>
                </li>
                <?php
            }
            ?>
            <li>
                <a href="logout.php">
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>

    </div>
    <div class="main-content tw-h-[600px]">
  <h3>Account</h3>
  <p class="location"><span class="colored-text">IskulRec/</span>Account</p>


  <div  class="tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full">
    <div id="info-container" class="tw-bg-[#FAF9F6] tw-rounded-md tw-p-5 tw-shadow-lg tw-w-[700px] tw-h-full">
        <div class="tw-flex tw-w-full tw-align-middle tw-justify-between tw-items-center">
            <p class="md:tw-text-2xl tw-uppercase tw-m-0 tw-font-bold ">Account Information</p>
            <i class='fi fi-rr-edit tw-text-[25px] tw-m-0 tw-cursor-pointer tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-rounded-lg hover:tw-bg-gray-200' id="edit-btn"></i>
        </div>
        <div class="tw-pt-11">
      

                <div class="tw-flex tw-row tw-items-center tw-text-xl">
                    <p>User ID:</>
                    
                    <p class="tw-ml-6"><?php echo $_SESSION['user_id']; ?></p>
                </div>
                <div class="tw-flex tw-row tw-items-center tw-text-xl tw-mt-4">
                    <p>Full Name:</p  >
                  
                    <p class="tw-capitalize tw-ml-6"><?php echo  $_SESSION['full-name']; ?></p>
                </div>

                <div class="tw-flex tw-row tw-items-center tw-text-xl tw-mt-4">
                    <p>Username:</p>
                    
                    <p class="tw-ml-6"><?php echo $_SESSION['username'];?></p>
                </div>

                <div class="tw-flex tw-row tw-items-center tw-text-xl tw-mt-4">
                    <p>Status:</p>
                    
                    <p class="tw-ml-6"><?php echo $_SESSION['status']; ?></p>
                </div>
      
        </div>
    </div>
            
    <div id="edit-container" class="tw-bg-[#FAF9F6] tw-rounded-md tw-p-5 tw-shadow-lg tw-w-[700px] tw-h-full tw-hidden">
        <div class="tw-flex tw-w-full tw-align-middle tw-justify-between tw-items-center">
            <p class="md:tw-text-2xl tw-uppercase tw-m-0 tw-font-bold ">Edit Information</p>
            <i class='fi fi-rr-edit tw-text-[25px] tw-m-0 tw-cursor-pointer tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-rounded-lg hover:tw-bg-gray-200' id="edit-btn"></i>
        </div>
        <div class="tw-pt-11">
        <form method="post">
            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl tw-h-16">
                <label for="ID">User ID:</label>
                <input id="ID" class="tw-rounded-md tw-h-10 tw-p-3" name="ID" type="number" readonly placeholder="<?php echo $_SESSION['user_id']; ?>">
            </div>
            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl  tw-h-16">
                <label for="full-name">Full Name:</label>
                <input id="full-name" class="tw-rounded-md tw-h-10 tw-p-3 tw-capitalize" type="text" name="full-name" placeholder="<?php echo $_SESSION['full-name']; ?>">
            </div>

            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl  tw-h-16">
                <label for="username">Username:</label>
                <input id="username" autocomplete="username" class="tw-rounded-md tw-h-10 tw-p-3" type="text" name="username" placeholder="<?php echo $_SESSION['username'] ?> ">
            </div>

            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl  tw-h-16">
                <label for="c-password">Current Password:</label>
                <input id="c-password" class="tw-rounded-md tw-h-10 tw-p-3" type="text" name="c-password" placeholder="Current Password">
            </div>
            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl  tw-h-16">
                <label for="new-password">New Password:</label>
                <input id="new-password" class="tw-rounded-md tw-h-10 tw-p-3" type="text" name="new-password" placeholder="New Password">
            </div>
            <div class="tw-grid tw-grid-cols-custom2 tw-row tw-items-center tw-text-xl  tw-h-16">
                <label for="conf-password">Confirm Password:</label>
                <input id="conf-password" class="tw-rounded-md tw-h-10 tw-p-3" type="text" name="conf-password" placeholder="Confirm Password">
            </div>

            <input type="submit" value="submit">
        </form>

        </div>
    </div>
  </div>
</div>
    </div>


    <script src="../js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userPage = document.querySelector('.user');
            userPage.addEventListener('click', function() {
                window.location.href = "account.php";
            });
        });

        let editbtns = document.querySelectorAll('#edit-btn');
        let editContainer = document.getElementById('edit-container');
        let info = document.getElementById('info-container');

        editbtns.forEach(editbtn => {
            editbtn.addEventListener('click', e => {
                info.classList.toggle('tw-hidden');
                editContainer.classList.toggle('tw-hidden');
            });
        });

    </script>
</body>
</html>