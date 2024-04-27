<?php
include("../php/conn.php");

// Add PHP code to handle form submission and update the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentID = $_POST['edit-ID'];
    $firstName = $_POST['edit-first-name'];
    $middleName = $_POST['edit-middle-name'];
    $lastName = $_POST['edit-last-name'];
    $gender = $_POST['edit-gender'];
    $birthdate = $_POST['edit-birthdate'];
    $address = $_POST['edit-address'];
    $motherName = $_POST['edit-mother-name'];
    $motherOccupation = $_POST['edit-mother-occupation'];
    $fatherName = $_POST['edit-father-name'];
    $fatherOccupation = $_POST['edit-father-occupation'];
    $guardianName = $_POST['edit-guardian-name'];
    $guardianPhone = $_POST['edit-guardian-phone'];

    // Update the student record in the database
    $sql = "UPDATE students SET firstName='$firstName', midName='$middleName', surname='$lastName', gender='$gender', birthdate='$birthdate', compAddress='$address', motherName='$motherName', motherOccupation='$motherOccupation', fatherName='$fatherName', fatherOccupation='$fatherOccupation', guardianName='$guardianName', guardianPhone='$guardianPhone' WHERE ID='$studentID'";

    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student information updated successfully')</script>";
    } else {
        echo "Error updating student information: " . $conn->error;
    }
    
    $conn->close();
}
?>
