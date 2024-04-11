<?php
include("../php/conn.php");

$sql = "SELECT studentID FROM students ORDER BY studentID DESC LIMIT 1";
$result = $conn->query($sql);
$nextID = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastID = $row['studentID'];
    $nextID = $lastID +1;
} else {
    $nextID = 0;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["first-name"];
    $middleName = $_POST["middle-name"];
    $lastName = $_POST["last-name"];
    $gender = $_POST["gender-options"];
    $birthdate = $_POST["student-birthdate"];
    $guardianPhone = $_POST["guardian-phone"];
    $remarks = $_POST["student-remarks"];

    // Insert data into the database
    $sql = "INSERT INTO students (firstName, midName, surname, gender, birthdate, guardianPhone, remarks) VALUES ('$firstName', '$middleName', '$lastName', '$gender', '$birthdate', '$guardianPhone', '$remarks')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New student record added successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="../styles/add-student.css?v=<?php echo time(); ?>">
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
        <button class="back-btn" onclick="history.back()"><img src="../icons/back-button.png" alt=""><span>Back</span></button>
        <div class="section-title">
            <img class="add-contact" src="../icons/add-contact.png" alt="">
            <p class="add-new">Add New Student</p>
        </div>
        <hr>
        <div class="fillup-form">
            <form action="" method="post">
                <div class="input-area">
                    <label for="student-id">Student ID:</label>
                    <div class="text-container">
                        <input name="student-id"type="text" placeholder="Student ID: <?php echo $nextID ?>" disabled>   
                    </div>
                    
                </div>
                <div class="input-area">
                    <label for="first-name">First Name:</label>
                    <div class="text-container">
                        <input class="capitalize-input" name="first-name"type="text" placeholder="First Name">
                    </div>
                </div>
                <div class="input-area">
                    <label for="middle-name">Middle Name:</label>
                    <div class="text-container">
                         <input class="capitalize-input" name="middle-name"type="text" placeholder="Middle Name">
                    </div>
                </div>
                <div class="input-area">
                    <label for="last-name">Last Name:</label>
                    <div class="text-container">
                         <input class="capitalize-input" name="last-name"type="text" placeholder="Last Name">
                    </div>
                </div>
                <div class="input-area">
                    <label class="gender-style" for="student-gender">Gender:</label>
                    <select class= "gender" name="gender-options" id="gender-options">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="input-area">
                    <label for="student-birthdate">Birthdate:</label>
                    <input class= "Birthdate" type="date" name="student-birthdate">
                </div>            
                <div class="input-area">
                    <label for="guardian-phone">Guardian Phone:</label>
                    <input type="number" name="guardian-phone">
                </div>
                <div class="input-area">
                    <label class="remarks" for="student-remarks">Remarks:</label>
                </div>
                <div>
                    <textarea class="capitalize-input" name="student-remarks" cols="30" rows="10"></textarea>
                </div>
                <input class="submit-btn" type="submit">
            </form>
        </div>
      </div>
      <script src="../js/script.js"></script>
      <script>
            const inputElements = document.querySelectorAll('.capitalize-input');

            // Add input event listener to each element
            inputElements.forEach(function (inputElement) {
                inputElement.addEventListener('input', function () {
                    // Get the current value of the input
                    let inputValue = this.value;

                    // Capitalize the input value
                    let capitalizedValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);

                    // Update the input value with the capitalized version
                    this.value = capitalizedValue;
                });
            });
    </script>
</body>
</html>