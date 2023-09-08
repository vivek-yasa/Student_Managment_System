<?php
include('Connection.php');
    $s_name= $_POST['name'];
    $m_name= $_POST['mother_name'];
    $f_name= $_POST['father_name'];
    $number= $_POST['mobile_number'];
    $s_standard= $_POST['standard'];
    $s_section= $_POST['section'];
    $s_password= $_POST['password'];
    $query="INSERT INTO `students_data`(`name`, `mother_name`, `father_name`, `mobile_number`, `standard`, `section`, `password`) VALUES ('$s_name','$m_name','$f_name','$number','$s_standard','$s_section','$s_password')";
   
    if(mysqli_query($con,$query)){
    echo "<script>alert('student information added successfully')</script>";
    header("Location:faculty_main_web.html");
}
?>

