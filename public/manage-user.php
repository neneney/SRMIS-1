<?php
include("../php/conn.php");
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}



if(isset($_GET['search']) && !empty($_GET['search'])) {

    $searchTerm = htmlspecialchars($_GET['search']);
    

    $sql = "SELECT * FROM users WHERE 
            ID LIKE '%$searchTerm%' OR 
            `full-name` LIKE '%$searchTerm%' OR 
            username LIKE '%$searchTerm%' OR 
            `type` LIKE '%$searchTerm%'";

    $result = $conn->query($sql);
    
} else {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
}


if(!$result) {
    echo "Error executing SQL query: " . $conn->error;
}


$sqlTotal = "SELECT COUNT(*) AS total FROM users"; // Change 'users' to your table name
$resultTotal = $conn->query($sqlTotal);

if ($resultTotal) {
    $rowTotal = $resultTotal->fetch_assoc();
    $totalRows = $rowTotal['total'];
} else {
    echo "Error: " . $conn->error;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link rel="stylesheet" href="../src/manage-user.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../src/navbar.css?v=<?php echo time(); ?>">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/tailwind.css">
    
    <style>
    [x-cloak] {
      display: none;
    }
  </style>

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
                <img src="../images/BJMP_Logo.png" alt="logo" style="height: 40px;">
                <span>IskulRec</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <img src="../images/user-image.png" class ="user-img" alt="user">
            <div>
                <p class="user-name"><?php echo $_SESSION['full-name']; ?></p>
                <p class="admin">Admin</p>
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
            <li>
                <a href="manage-user.php">
                    <i class="fi fi-rr-admin-alt"></i>
                    <span class="nav-item">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>

    </div>
    
    <div class="main-content">
        <h3>Users</h3>
        <p class="location"><span class="colored-text">IskulRec/</span>Manage Users</p>
        <p class="total">Total number of users: [<?php echo $totalRows?>]</p>  
        <div class="mid-container">
            <div class=" text-box ">
                <form method="GET">
                    <input class="search-box" type="search" name="search" placeholder="Search users" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </form>
            </div>
           
            <button  id = "add-user-btn" class=" add-user-btn" >
            <i class="fi fi-rr-user-add"></i>Add User</button>
        </div>
       
        <div class="table">
          <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php


                if(!$result) {
                    // Handle error (e.g., log it, display an error message)
                    echo "Error executing SQL query: " . $conn->error;
                } else {
                    // Iterate through the result set to display data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['full-name'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td class='tw-uppercase'>" . $row['status'] . "</td>";
                        echo "<td class='tw-w-[250px]'>";
                        echo "<div class='action-btn'>";
                        echo "<button id='edit-btn' class='tw-bg-slate-500 tw-border-none tw-rounded-md tw-shadow-md tw-align-middle tw-w-16 tw-h-8 tw-text-white' 
                        data-id='" . $row['ID'] . "' 
                        data-fullname='" . $row['full-name'] . "' 
                        data-username='" . $row['username'] . "'
                        data-status='" . $row['status'] . "' >
                        <i class='fi fi-rr-edit tw-text-[18px] tw-m-0 tw-text-center'></i>
                        </button>";
                        echo "<button class='tw-bg-red-500 tw-border-none tw-rounded-md tw-shadow-md tw-m-0  tw-align-middle tw-w-16 tw-h-8 tw-text-white' onclick='blockUser(" . $row['ID'] . ")'><i class='fi fi-rr-ban tw-text-[20px]  tw-m-0 tw-text-center'></i></button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                      
                    }
                }
                
                ?>  
        </table>
        </div>
      </div>
                
        <div class="add-container"> 
            <div class="popup addUser"  id="addContainer">
                <div class="ad-top-section">
                    <img src="../images/BJMP_Logo.png" alt="logo" class="bjmp-logo">
                    <h2 id=admission-header>Add User</h2>
                </div>
                <hr class="tw-mt-4 tw-mb-4">
                <form action="add_user.php" method="post" class="addForm">
                <div class="top-box">
                    <div class="input-area">
                        <label for="">User ID:</label>
                        <input id ="ID" name ="ID" type="number" placeholder="Enter User ID" required>
                    </div>

                    <div class="input-area">
                        <label for="">Full Name:</label>
                        <input id="full-name" class="input" name="full-name" type="text" placeholder="Enter Full Name" required>
                    </div>
                    <div class="input-area">
                        <label for="">Username:</label>
                        <input id="username" class="input" name="username" type="text" placeholder="Enter Username" Required>
                    </div>
                    <div class="input-area">
                        <label for="">Password:</label>
                        <input id="password" class="input" name="password" type="password" placeholder="Enter Password " Required>
                    </div>
                    <div class="input-area">
                        <label for="">Confirm Password:</label>
                        <input id="confirm-pass" class="input" name="confirm-pass" type="password" placeholder="Confirm Password " Required>
                    </div>
                </div>
                <div class="alert"></div>
                    <hr class="tw-mt-4 tw-mb-5">
                    <div class="btns">
                        <button class="cancel-btn" type="reset" id="cancel-btn">Cancel</button>
                        <input name="submit-btn" class="submit-btn"  type="submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="edit-container">
            <div class="popup editUser"  id="editContainer">
                <div class="ad-top-section">
                    <img src="../images/BJMP_Logo.png" alt="logo" class="bjmp-logo">
                    <h2>Edit User</h2>
                </div>
                <hr class="tw-mt-4 tw-mb-4">
                <form action="edit_user.php" method="post" class="editForm">
                        <div class="top-box">
                            <div class="input-area">
                                <label for="">User ID:</label>
                                <input id ="edit-ID" name ="ID" type="number" placeholder="Enter User ID" required>
                            </div>
                            <div class="input-area">
                                <label for="">Full Name:</label>
                                <input id="edit-full-name" class="input" name="full-name" type="text" placeholder="Enter Full Name" required>
                            </div>
                            <div class="input-area">
                                <label for="">Username:</label>
                                <input id="edit-username" class="input" name="username" type="text" placeholder="Enter Username" Required>
                            </div>
                            <div class="input-area">
                                <label for="">Password:</label>
                                <input id="edit-password" class="input" name="password" type="password" placeholder="Enter Password ">
                            </div>
                            <div class="input-area">
                                <label for="">Confirm Password:</label>
                                <input id="edit-confirm-pass" class="input" name="confirm-pass" type="password" placeholder="Confirm Password ">
                            </div>
                            <div class="input-area">
                                <label for="">Status:</label>
                                <p class="tw-uppercase tw-font-semibold" id="edit-status"></p>
                            </div>
                        </div>
                        <div class="alert"></div>
                            <hr class="tw-mt-4 tw-mb-5">
                            <div class="btns">
                                <button class="cancel-btn" type="reset" id="edit-cancel-btn">Cancel</button>
                                <input name="submit-btn" class="submit-btn"  type="submit">
                            </div>
                </form>
            </div>
        </div>

    <script src="../js/script.js"></script>
    <script src="../js/manage-user.js"></script>
    
</body>
</html>
</body>
</html>