<?php
include("../php/conn.php");


// Check if search term is set and not empty
if(isset($_GET['search']) && !empty($_GET['search'])) {
    // Sanitize the search term
    $searchTerm = htmlspecialchars($_GET['search']);
    
    // Prepare the SQL statement with a parameterized query to prevent SQL injection
    $sql = "SELECT * FROM students WHERE 
            ID LIKE '%$searchTerm%' OR 
            firstName LIKE '%$searchTerm%' OR 
            midName LIKE '%$searchTerm%' OR 
            surname LIKE '%$searchTerm%' OR 
            gender LIKE '%$searchTerm%' OR 
            guardianPhone LIKE '%$searchTerm%'";
    
    // Execute the query
    $result = $conn->query($sql);
    
} else {
    // If search term is not set, fetch all students
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
}

if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
    
}



// Check for errors in SQL query
if(!$result) {
    // Handle error (e.g., log it, display an error message)
    echo "Error executing SQL query: " . $conn->error;
}

// Count total male students
$sqlMale = "SELECT COUNT(*) AS totalMale FROM students WHERE gender = 'male'";
$resultMale = $conn->query($sqlMale);
$rowMale = $resultMale->fetch_assoc();
$totalMale = $rowMale['totalMale'];

// Count total female students
$sqlFemale = "SELECT COUNT(*) AS totalFemale FROM students WHERE gender = 'female'";
$resultFemale = $conn->query($sqlFemale);
$rowFemale = $resultFemale->fetch_assoc();
$totalFemale = $rowFemale['totalFemale'];

// Calculate total number of students
$totalStudents = $totalMale + $totalFemale;

// Close prepared statement

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
    
    <style>
    [x-cloak] {
      display: none;
    }
  </style>

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
                <p class="tw-mb-3">STUDENT ID: <span class="tw-span" id="student_id">01923910293</span></p>
                <p class="tw-mb-3">NAME: <span class="tw-span" id="student_name"></span></p>
                <p class="tw-mb-3">ADDRESS: <span class="tw-span" id="student_address">blk123 lot123 bellavista subd santiago general trias cavite</span></p>
                <div class="grid tw-grid tw-grid-cols-2 tw-gap-3">
                    <p> GENDER: <span class="tw-span" id="student_gender">Male</span></p>
                    <p>BIRTHDATE: <span class="tw-span" id="student_birthdate">02/15/2002</span></p>
                    <p>MOTHER'S NAME: <span class="tw-span" id="mother_name">Lorem, ipsum dolor.</span></p>
                    <p>OCCUPATION: <span class="tw-span" id="mother_occu">Lorem, ipsum dolor.</span></p>
                    <p>FATHERS'S NAME: <span class="tw-span" id="father_name">Lorem, ipsum dolor. Lorem.</span></p>
                    <p>OCCUPATION: <span class="tw-span" id="father_occu">Lorem, ipsum dolor.</span></p>
                    <p>GUARDIANS'S NAME: <span class="tw-span" id="guardian_name">Lorem, ipsum dolor.</span></p>
                    <p>PHONE: <span class="tw-span" id="guardian_phone">Lorem, ipsum dolor.</span></p>
                </div>
                <hr class="tw-mt-4 tw-mb-4">
                <div class="tw-flex tw-justify-center">
                    <button class="cancel-btn" type="reset" onclick="closeV()">Close</button>
                    <button class="submit-btn" type="submit">Print</button>
                </div>
        </div>

    <div class="main-content">
        <h3>Students</h3>
        <p class="location"><span class="colored-text">SRMIS / </span>Manage Students</p>
        <p class="total">Total number of students: [<?php echo $totalStudents?>]</p>  
        <div class="mid-container">
            <div class=" text-box ">
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
            <button  id = "add-student-btn" class=" add-student-btn" >
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


                if(!$result) {
                    // Handle error (e.g., log it, display an error message)
                    echo "Error executing SQL query: " . $conn->error;
                } else {
                    // Iterate through the result set to display data
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
                        echo "<button id='view-btn'  class='tw-bg-emerald-500 tw-border-none tw-rounded-md tw-shadow-md tw-align-middle tw-w-16 tw-h-8 tw-text-white'
                        data-id='" . $row['ID'] . "' 
                        data-firstname='" . $row['firstName'] . "' 
                        data-midname='" . $row['midName'] . "' 
                        data-surname='" . $row['surname'] . "' 
                        data-gender='" . $row['gender'] . "' 
                        data-birthdate='" . $row['birthdate'] . "' 
                        data-compaddress='" . $row['compAddress'] . "' 
                        data-mothername='" . $row['motherName'] . "' 
                        data-motheroccupation='" . $row['motherOccupation'] . "' 
                        data-fathername='" . $row['fatherName'] . "' 
                        data-fatheroccupation='" . $row['fatherOccupation'] . "' 
                        data-guardianname='" . $row['guardianName'] . "' 
                        data-guardianphone='" . $row['guardianPhone'] . "'> 
                        <i class='fi fi-rr-eye tw-text-[20px] tw-m-0 tw-text-center'></i></button>";
                        echo "<button id='edit-btn' class='tw-bg-slate-500 tw-border-none tw-rounded-md tw-shadow-md tw-align-middle tw-w-16 tw-h-8 tw-text-white' 
                        data-id='" . $row['ID'] . "' 
                        data-firstname='" . $row['firstName'] . "' 
                        data-midname='" . $row['midName'] . "' 
                        data-surname='" . $row['surname'] . "' 
                        data-gender='" . $row['gender'] . "' 
                        data-birthdate='" . $row['birthdate'] . "' 
                        data-compaddress='" . $row['compAddress'] . "' 
                        data-mothername='" . $row['motherName'] . "' 
                        data-motheroccupation='" . $row['motherOccupation'] . "' 
                        data-fathername='" . $row['fatherName'] . "' 
                        data-fatheroccupation='" . $row['fatherOccupation'] . "' 
                        data-guardianname='" . $row['guardianName'] . "' 
                        data-guardianphone='" . $row['guardianPhone'] . "'>
                <i class='fi fi-rr-edit tw-text-[18px] tw-m-0 tw-text-center'></i>
              </button>";
                        echo "<button class='tw-bg-red-500 tw-border-none tw-rounded-md tw-shadow-md tw-m-0  tw-align-middle tw-w-16 tw-h-8 tw-text-white' onclick='deleteStudent(" . $row['ID'] . ")'><i class='fi fi-rr-trash tw-text-[20px]  tw-m-0 tw-text-center'></i></button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                      
                    }
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
        <form action="add_student.php" method="post" class="addForm">
            <div class="input-area1">
            <label for="">Student ID</label>
            <input id ="ID" name ="ID" type="number" placeholder="Enter Student ID" required>
            </div>
            <div class="top-box">
            <div class="input-area">
                <label for="">First Name</label>
                <input id="first-name" class="input" name="first-name" type="text" placeholder="Enter First Name" required>
            </div>
            <div class="input-area">
                <label for="">Middle Name</label>
                <input id="middle-name" class="input" name="middle-name" type="text" placeholder="Enter Middle Name" Required>
            </div>
            <div class="input-area">
                <label for="">Last Name</label>
                <input id="last-name" class="input" name="last-name" type="text" placeholder="Enter Last Name" required>
            </div>
            </div>
            <div class="basic-info">
            <div class="gender">
                <p>Gender:</p>
                <input id="gender" name="gender" type="radio" value="Male" required>
                <label for="">Male</label>
                <input id="gender" name="gender" type="radio" value="Female" required>
                <label for="">Female</label>
            </div>
            <div class="Birthdate">
                <label for="">Birthdate</label>
                <input id="birthdate" name="birthdate" type="date" class="input" required>
            </div>
            </div>
            
            
            <div class="grid-info-box">
            
            <label class="add-label"for="">Complete address</label>
            <input id="address" class="add-input" name="address" type="text" name="" id="" placeholder="Enter Complete Address">

            <label for="">Mother's Name</label>
            <input id="mother-name" class="input" name="mother-name" type="text" placeholder="Enter Mother's Name" required>
            <label for="">Occupation</label>
            <input id="mother-occupation" name="mother-occupation" type="text" placeholder="Enter Occupation" required>        
            
            <label for="">Father's Name</label>
            <input id="father-name" class="input" name="father-name" type="text" placeholder="Enter Father's Name" required>
            <label for="">Occupation</label>
            <input id="father-occupation" name="father-occupation" type="text" placeholder="Enter Occupation" required>        
            
            <label for="">Guardian's Name</label>
            <input id="guardian-name" name="guardian-name"  type="text" placeholder="Enter Guardian's Name" required>
            <label for="">Phone Number</label>
            <input id = "guardian-phone" name="guardian-phone" type="number" placeholder="Enter Phone Number" required>        
            </div>
            <div class="alert">Please enter a valid 11-digit phone number.</div>
            <hr class="tw-mt-4 tw-mb-5">
            <div class="btns">
                <button class="cancel-btn" type="reset" id="cancel-btn">Cancel</button>
                <input name="submit-btn" class="submit-btn"  type="submit">
            </div>
            </form>
            </div>
            </div>

        <div class="admission-container">
        <div class="popup editStudent"  id="editContainer">
        <div class="ad-top-section">
            <img src="../images/BJMP_Logo.png" alt="logo" class="bjmp-logo">
            <h2 id=admission-header>Edit Info</h2>
        </div>
        <hr class="tw-mt-4 tw-mb-4">
        <form action="update_student.php" method="post" class="addForm">
            <div class="input-area1">
            <label for="">Student ID</label>
            <input name ="edit-ID" type="number" placeholder="Enter Student ID" required>
            </div>
            <div class="top-box">
            <div class="input-area">
                <label for="">First Name</label>
                <input class="input" name="edit-first-name" type="text" placeholder="Enter First Name" required>
            </div>
            <div class="input-area">
                <label for="">Middle Name</label>
                <input class="input" name="edit-middle-name" type="text" placeholder="Enter Middle Name" Required>
            </div>
            <div class="input-area">
                <label for="">Last Name</label>
                <input class="input" name="edit-last-name" type="text" placeholder="Enter Last Name" required>
            </div>
            </div>
            <div class="basic-info">
            <div class="gender">
                <p>Gender:</p>
                <input name="edit-gender" type="radio" value="Male" required>
                <label for="">Male</label>
                <input name="edit-gender" type="radio" value="Female" required>
                <label for="">Female</label>
            </div>
            <div class="Birthdate">
                <label for="">Birthdate</label>
                <input name="edit-birthdate" type="date" class="input" required>
            </div>
            </div>
            
            <div class="grid-info-box">

            <label class="add-label" for="">Complete address</label>
            <input class="add-input" name="edit-address" type="text" id="" placeholder="Enter Complete Address">

            <label for="">Mother's Name</label>
            <input class="input" name="edit-mother-name" type="text" placeholder="Enter Mother's Name" required>
            <label for="">Occupation</label>
            <input name="edit-mother-occupation" type="text" placeholder="Enter Occupation" required>        
            
            <label for="">Father's Name</label>
            <input class="input" name="edit-father-name" type="text" placeholder="Enter Father's Name" required>
            <label for="">Occupation</label>
            <input name="edit-father-occupation" type="text" placeholder="Enter Occupation" required>        
            
            
            <label for="">Guardian's Name</label>
            <input name="edit-guardian-name"  type="text" placeholder="Enter Guardian's Name" required>
            <label for="">Phone Number</label>
            <input name="edit-guardian-phone" type="number" placeholder="Enter Occupation" required>        
            </div>
            <hr class="tw-mt-4 tw-mb-5">
            <div class="btns">
                <button class="cancel-btn" type="reset" id="edit-cancel-btn">Cancel</button>
                <input class="submit-btn"  type="submit">
            </div>
        </form>
        
        </div>
        
        </div>

    <script src="../js/script.js"></script>
    <script src="../js/manage-student.js"></script>
    

</body>
</html>