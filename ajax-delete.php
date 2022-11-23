<?php

$student_id = $_POST['id'];
$con = mysqli_connect("localhost","root","","testing") or die("connection failed");

$sql= "DELETE FROM student WHERE id = {$student_id}";
// $result= mysqli_query($con,$sql) or die("query failder");
if(mysqli_query($con,$sql)){
    echo 1;
}else{
    echo 0;
}
?>