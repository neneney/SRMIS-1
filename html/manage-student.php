<?php
include("../php/conn.php");



// Query to get all student records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Handle search form submission
if(isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  // Modify the query to include the search term
  $sql = "SELECT * FROM students WHERE 
          ID LIKE '%$searchTerm%' OR 
          firstName LIKE '%$searchTerm%' OR 
          midName LIKE '%$searchTerm%' OR 
          surname LIKE '%$searchTerm%' OR 
          gender LIKE '%$searchTerm%' OR 
          guardianPhone LIKE '%$searchTerm%'";
  $result = $conn->query($sql);
}
// Query to get the total number of male students
$sqlMale = "SELECT COUNT(*) AS totalMale FROM students WHERE gender = 'male'";
$resultMale = $conn->query($sqlMale);
$rowMale = $resultMale->fetch_assoc();
$totalMale = $rowMale['totalMale'];

// Query to get the total number of female students
$sqlFemale = "SELECT COUNT(*) AS totalFemale FROM students WHERE gender = 'female'";
$resultFemale = $conn->query($sqlFemale);
$rowFemale = $resultFemale->fetch_assoc();
$totalFemale = $rowFemale['totalFemale'];

// Calculate the total number of students
$totalStudents = $totalMale + $totalFemale;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="../styles/manage-student.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/navbar.css?v=<?php echo time(); ?>">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>

    <div class="header">
      <div class="left-section">
        <a href="dashboard.php">Bureau of Jail Management and Penology</a>
      </div>
      <div class="right-section">
        <i class="fi fi-rr-sign-out-alt"></i>
        <a href="login.html" class="logout">Logout</a>
      </div>
    </div>

    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="bx bxl-codepen"></i>
                <span>SRMIS</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <img src="../images/user-image.png" class ="user-img" alt="user">
            <div>
                <p class="bold">User's Name</p>
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
                <a href="add-student.php">
                    <i class="fi fi-rr-user-add"></i>
                    <span class="nav-item">Add Students</span>
                </a>
                <span class="tooltip">Add Students</span>
            </li>
            <li>
                <a href="#">
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>

    </div>
    
    <div class="main-content">
        <h3>Students</h3>
        <p class="location"><span class="colored-text">Dashboard / </span>Students</p>
        <button class="back-btn" onclick="history.back()" ><img src="../icons/back-button.png" alt=""><span>Back</span></button>
        <p class="total">Total number of students: [<?php echo $totalStudents?>]</p>  
        <div class="mid-container">
            <div class="text-box">
                <form method="GET">
                    <input class="search-box" type="search" name="search" placeholder="Search students" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </form>
            </div>
            <div class="right-btn">
            <select name="cars" id="cars">
                <option value="">Sort By</option>
                <option value="volvo">Student ID</option>
                <option value="saab">First name</option>
                <option value="mercedes">Last Name</option>
            </select>
                
            </div>
            <button id = "openAddStudentPopup" class="add-student-btn" onclick="toggleAdmissionForm()">Add Student</button>
            </div>

       
        <div class="table">
          <table>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Guardian Phone</th>
                <th>Action</th>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['midName'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['guardianPhone'] . "</td>";
                    echo "<td>";
                    echo "<div class='action-btn'>";
                    echo "<button class='view-btn'>View</button>";
                    echo "<button class='edit-btn'>Edit</button>";
                    echo "<button class='delete-btn' onclick='deleteStudent(" . $row['ID'] . ")'>Delete</button>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
        </table>
        </div>
      </div>
      <div class="admission-container">
        <div class="addStudent"  id="admissionContainer">
        <div class="ad-top-section">
            <img src="../images/BJMP_Logo.png" alt="logo" class="bjmp-logo">
            <h2>Student admission</h2>
        </div>
        <hr>
        <form action="#" method="post" class="addForm">
            <div class="input-area1">
            <label for="">Student ID</label>
            <input type="text" placeholder="Enter Student ID" required>
            </div>
            <div class="top-box">
            <div class="input-area">
                <label for="">First Name</label>
                <input type="text" placeholder="Enter First Name" required>
            </div>
            <div class="input-area">
                <label for="">Middle Name</label>
                <input type="text" placeholder="Enter Middle Name" Required>
            </div>
            <div class="input-area">
                <label for="">Last Name</label>
                <input type="text" placeholder="Enter Last Name" required>
            </div>
            </div>
            <div class="basic-info">
            <div class="gender">
                <p>Gender:</p>
                <input name="gender" type="radio" value="male">
                <label for="">Male</label>
                <input name="gender" type="radio" value="female">
                <label for="">Female</label>
            </div>
            <div class="Birthdate">
                <label for="">Birthdate</label>
                <input type="date" required>
            </div>
            </div>
            <div class="address">
                <label for="">Complete address</label>
                <input type="text" name="" id="" placeholder="Enter Complete Address">
            </div>
            <div class="parent-box">
            <label for="">Mother's Name</label>
            <input type="text" placeholder="Enter Mother's Name" required>
            <label for="">Occupation</label>
            <input type="text" placeholder="Enter Occupation" required>        
            </div>
            <div class="parent-box">
            <label for="">Father's Name</label>
            <input type="text" placeholder="Enter Father's Name" required>
            <label for="">Occupation</label>
            <input type="text" placeholder="Enter Occupation" required>        
            </div>
            <div class="parent-box">
            <label for="">Guidian's Name</label>
            <input type="text" placeholder="Enter Guidian's Name" required>
            <label for="">Phone Number</label>
            <input type="text" placeholder="Enter Occupation" required>        
            </div>
            <div class="btns">
            <button class="cancel-btn" onclick="closePopup()">Cancel</button>
            <button class="submit-btn" type="submit">Submit</button>
            </div>
        </form>
        </div>
        </div>
        </div>
        
    <script src="../js/script.js"></script>
    <script>
        function deleteStudent(studentID) {
            if (confirm("Are you sure you want to delete this student?")) {
                var xhr = new XMLHttpRequest();

                
                xhr.open("GET", "delete-student.php?id=" + studentID, true);

                
                xhr.send();

                
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        location.reload();
                    } else {
                        alert("Error deleting student record.");
                    }
                };
            }
            }

        function toggleAdmissionForm() {
            var admissionForm = document.getElementById("admissionContainer");
            admissionForm.style.opacity = "1";
            admissionForm.style.visibility = "visible";
        }
        function closePopup(){
            var admissionForm = document.getElementById("admissionContainer")
            admissionForm.style.opacity = "0";
        }
                
    </script>
</body>
</html>