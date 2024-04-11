<?php
include("../php/conn.php");

// Add PHP code to handle form submission and update the database
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

    // Update the student record in the database
    $sql = "UPDATE students SET firstName='$firstName', midName='$middleName', surname='$lastName', gender='$gender', birthdate='$birthdate', compAddress='$address', motherName='$motherName', motherOccupation='$motherOccupation', fatherName='$fatherName', fatherOccupation='$fatherOccupation', guardianName='$guardianName', guardianPhone='$guardianPhone' WHERE ID='$studentID'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student information updated successfully')</script>";
    } else {
        echo "Error updating student information: " . $conn->error;
    }
}
?>
