<?php
include("../php/conn.php");

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if(isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
 
  $sql = "SELECT * FROM students WHERE 
          ID LIKE '%$searchTerm%' OR 
          firstName LIKE '%$searchTerm%' OR 
          midName LIKE '%$searchTerm%' OR 
          surname LIKE '%$searchTerm%' OR 
          gender LIKE '%$searchTerm%' OR 
          guardianPhone LIKE '%$searchTerm%'";
  $result = $conn->query($sql);
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentID = $_POST['ID'];
    $firstName = $_POST['first-name'];
    $middleName = $_POST['middle-name'];
    $lastName = $_POST['last-name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $motherName = $_POST['mother-name'];
    $motherOccupation = $_POST['mother-occupation'];
    $fatherName = $_POST['father-name'];
    $fatherOccupation = $_POST['father-occupation'];
    $guardianName = $_POST['guardian-name'];
    $guardianPhone = $_POST['guardian-phone'];


    $sql = "INSERT INTO students (ID, firstName, midName, surname, gender, birthdate, compAddress, motherName, motherOccupation, fatherName, 
                                fatherOccupation, guardianName, guardianPhone) 
                    VALUES ('$studentID', '$firstName', '$middleName', '$lastName', '$gender', '$birthdate',
                    '$address', '$motherName', '$motherOccupation', '$fatherName', '$fatherOccupation', '$guardianName', '$guardianPhone')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New student record added successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="../src/manage-student.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../src/navbar.css?v=<?php echo time(); ?>">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/tailwind.css">
    
</head>
<body>

    <div class="header">
      <div class="left-section">
        <a href="dashboard.php" class="">Bureau of Jail Management and Penology</a>
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
    
    <div class="view-popup tw-bg-primary tw-text-white tw-p-20px tw-rounded-md tw-font-sans tw-text-lg" id="viewPopup">
            <div class="flex tw-justify-center tw-items-center"> 
                <img src="../images/BJMP_Logo.png" class="tw-w-20 tw-mr-4" alt="">
                <h2 class="tw-uppercase">view info</h2>
            </div>
            <hr class="tw-mt-4 tw-mb-4">
                <p class="tw-mb-3">STUDENT ID: <span class="tw-span">01923910293</span></p>
                <p class="tw-mb-3">NAME: <span class="tw-span">Sample only output</span></p>
                <p class="tw-mb-3">ADDRESS: <span class="tw-span">blk123 lot123 bellavista subd santiago general trias cavite</span></p>
                <div class="grid tw-grid tw-grid-cols-2 tw-gap-3">
                    <p> GENDER: <span class="tw-span">Male</span></p>
                    <p>BIRTHDATE: <span class="tw-span">02/15/2002</span></p>
                    <p>MOTHER'S NAME: <span class="tw-span">Lorem, ipsum dolor.</span></p>
                    <p>OCCUPATION: <span class="tw-span">Lorem, ipsum dolor.</span></p>
                    <p>FATHERS'S NAME: <span class="tw-span">Lorem, ipsum dolor. Lorem.</span></p>
                    <p>OCCUPATION: <span class="tw-span">Lorem, ipsum dolor.</span></p>
                    <p>GUARDIANS'S NAME: <span class="tw-span">Lorem, ipsum dolor.</span></p>
                    <p>PHONE: <span class="tw-span">Lorem, ipsum dolor.</span></p>
                </div>
                <hr class="tw-mt-4 tw-mb-4">
                <div class="tw-flex tw-justify-center">
                    <button class="cancel-btn" type="reset" onclick="closeV()">Close</button>
                    <button class="submit-btn" type="submit">Print</button>
                </div>
        </div>

    <div class="main-content">
        <h3>Students</h3>
        <p class="location"><span class="colored-text">Dashboard / </span>Students</p>
        <button class="back-btn" onclick="history.back()" ><i class="fi fi-rr-arrow-small-left"></i><span>Back</span></button>
        <p class="total">Total number of students: [<?php echo $totalStudents?>]</p>  
        <div class="mid-container">
            <div class="text-box">
                <form method="GET">
                    <input class="search-box" type="search" name="search" placeholder="Search students" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </form>
            </div>
            <div class="right-btn">
            <form method="get">
                <select class="tw-bg-emerald-500" name="sort_by" id="sort" onchange="this.form.submit()">
                    <option value=""> <i class="fi fi-rr-sort-alt"></i> Sort By</option>
                    <option value="ID">Student ID</option>
                    <option value="firstName">First name</option>
                    <option value="surname">Last Name</option>
                </select>
            </form>
            </div>
            <button  id = "openAddStudentPopup" class=" add-student-btn" onclick="openAddstudent()">
            <i class="fi fi-rr-user-add"></i>Add Student</button>
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

                $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

                // Modify the query based on the selected sorting option
                $sql = "SELECT * FROM students";
                if ($sortBy) {
                    $sql .= " ORDER BY $sortBy";
                }

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['midName'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['guardianPhone'] . "</td>";
                    echo "<td class='tw-w-[250px]'>";
                    echo "<div class='action-btn'>";
                        echo "<button class='tw-bg-emerald-500 tw-border-none tw-rounded-md tw-shadow-md tw-align-middle tw-w-16 tw-h-8 tw-text-white' onclick='showViewPopup()'><i class='fi fi-rr-eye tw-text-[20px] tw-m-0 tw-text-center'></i></button>";
                        echo "<button class='tw-bg-slate-500 tw-border-none tw-rounded-md tw-shadow-md tw-align-middle   tw-w-16 tw-h-8 tw-text-white' onclick='editInfo(\"" . $row['ID'] . "\", \"" . $row['firstName'] 
                        . "\", \"" . $row['midName'] . "\", \"" . $row['surname'] . "\", \"" . $row['gender'] . "\", \"" 
                        . $row['birthdate'] . "\", \"" . $row['compAddress'] . "\", \"" . $row['motherName'] . "\", \"" . 
                        $row['motherOccupation'] . "\", \"" . $row['fatherName'] . "\", \"" . $row['fatherOccupation'] . "\", \"" . 
                        $row['guardianName'] . "\", \"" . $row['guardianPhone'] . "\")'><i class='fi fi-rr-edit tw-text-[18px]  tw-m-0 tw-text-center'></i></button>";
                        echo "<button class='tw-bg-red-500 tw-border-none tw-rounded-md tw-shadow-md tw-m-0  tw-align-middle tw-w-16 tw-h-8 tw-text-white' onclick='deleteStudent(" . $row['ID'] . ")'><i class='fi fi-rr-trash tw-text-[20px]  tw-m-0 tw-text-center'></i></button>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
        </table>
        </div>
        
      </div>
                
      <div class="admission-container">
        <div class="popup addStudent"  id="admissionContainer">
        <div class="ad-top-section">
            <img src="../images/BJMP_Logo.png" alt="logo" class="bjmp-logo">
            <h2 id=admission-header>Student admission</h2>
        </div>
        <hr class="tw-mt-4 tw-mb-4">
        <form action="" method="post" class="addForm">
            <div class="input-area1">
            <label for="">Student ID</label>
            <input name ="ID" type="number" placeholder="Enter Student ID" required>
            </div>
            <div class="top-box">
            <div class="input-area">
                <label for="">First Name</label>
                <input class="input" name="first-name" type="text" placeholder="Enter First Name" required>
            </div>
            <div class="input-area">
                <label for="">Middle Name</label>
                <input class="input" name="middle-name" type="text" placeholder="Enter Middle Name" Required>
            </div>
            <div class="input-area">
                <label for="">Last Name</label>
                <input class="input" name="last-name" type="text" placeholder="Enter Last Name" required>
            </div>
            </div>
            <div class="basic-info">
            <div class="gender">
                <p>Gender:</p>
                <input name="gender" type="radio" value="Male" required>
                <label for="">Male</label>
                <input name="gender" type="radio" value="Female" required>
                <label for="">Female</label>
            </div>
            <div class="Birthdate">
                <label for="">Birthdate</label>
                <input name="birthdate" type="date" required>
            </div>
            </div>
            <div class="address">
                <label for="">Complete address</label>
                <input name="address" type="text" name="" id="" placeholder="Enter Complete Address">
            </div>
            <div class="parent-box">
            <label for="">Mother's Name</label>
            <input class="input" name="mother-name" type="text" placeholder="Enter Mother's Name" required>
            <label for="">Occupation</label>
            <input name="mother-occupation" type="text" placeholder="Enter Occupation" required>        
            </div>
            <div class="parent-box">
            <label for="">Father's Name</label>
            <input class="input" name="father-name" type="text" placeholder="Enter Father's Name" required>
            <label for="">Occupation</label>
            <input name="father-occupation" type="text" placeholder="Enter Occupation" required>        
            </div>
            <div class="parent-box">
            <label for="">Guidian's Name</label>
            <input name="guardian-name"  type="text" placeholder="Enter Guidian's Name" required>
            <label for="">Phone Number</label>
            <input name="guardian-phone" type="number" placeholder="Enter Occupation" required>        
            </div>
            <hr class="tw-mt-4 tw-mb-5">
            <div class="btns">
                <button class="cancel-btn" type="reset" onclick="closePopup()">Cancel</button>
                <button class="submit-btn" type="submit">Submit</button>
            </div>
        </form>
        
        </div>
        
        </div>
       
      
    <script src="../js/script.js"></script>
    <script src="../js/manage-student.js"></script>
</body>
</html>