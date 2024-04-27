<?php
include("../php/conn.php");
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}


$sqlMale = "SELECT COUNT(*) AS totalMale FROM students WHERE gender = 'male'";
$resultMale = $conn->query($sqlMale);
$rowMale = $resultMale->fetch_assoc();
$totalMale = $rowMale['totalMale'];


$sqlFemale = "SELECT COUNT(*) AS totalFemale FROM students WHERE gender = 'female'";
$resultFemale = $conn->query($sqlFemale);
$rowFemale = $resultFemale->fetch_assoc();
$totalFemale = $rowFemale['totalFemale'];


$totalStudents = $totalMale + $totalFemale;


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../src/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../src/navbar.css?v=<?php echo time(); ?>">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/tailwind.css">
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
      <h1>Dashboard</h1>
      <hr>
      <h3>Student Record Mangement Information System</h3>
      <div class="numbers">
        <div class="mens">
          <p class="digit"><?php echo $totalMale ?></p>
          <p class="p-mens">mens</p>
          <p class = "p-insystem">in this system</p>
        </div>
        <div class="womens">
          <p class="digit"><?php echo $totalFemale ?></p>
          <p class="p-womens">womens</p>
          <p class = "p-insystem">in this system</p>
        </div>
        <div class="total">
          <p class="digit"><?php echo $totalStudents ?></p>
          <p class="p-total">total</p>
          <p class = "p-insystem">in this system</p>
        </div>
      </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>