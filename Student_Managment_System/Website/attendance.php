<?php
include('Connection.php');
$stmt = $con->prepare("INSERT INTO attendance (date, abhinay, harsha, rohith, akash, durga, partheev, vivek, varshith, karthik)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Get the form data
$date = $_POST['data'];
$abhinay = $_POST['student1'];
$harsha = $_POST['student2'];
$rohith = $_POST['student3'];
$akash = $_POST['student4'];
$durga = $_POST['student5'];
$partheev = $_POST['student6'];
$vivek = $_POST['student7'];
$varshith = $_POST['student8'];
$karthik = $_POST['student9'];

// Bind parameters to the SQL statement
$stmt->bind_param("ssssssssss", $date, $abhinay, $harsha, $rohith, $akash, $durga, $partheev, $vivek, $varshith, $karthik);

// Execute the SQL statement
if ($stmt->execute()) {
//echo "<script>alert('student information added successfully')</script>";
header("Location:faculty_main_web.html");
echo "<script>alert('student information added successfully')</script>";
} else {
echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>