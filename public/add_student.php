<?php
include("../php/conn.php");
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
