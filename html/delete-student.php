<?php
include("../php/conn.php");

if (isset($_GET['id'])) {
    $studentID = $_GET['id'];

    // Perform the delete operation
    $sqlDelete = "DELETE FROM students WHERE ID = '$studentID'";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "Student record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>