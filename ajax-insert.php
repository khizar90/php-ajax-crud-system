<?php
$fist_name = $_POST['frist_name'];
$last_name = $_POST['last_name'];
$con = mysqli_connect("localhost","root","","testing") or die("connection failed");

$sql= "INSERT INTO student(`id`, `first name`, `last name5`) VALUES ('','{$fist_name}','{$last_name}')";
// $result= mysqli_query($con,$sql) or die("query failder");
if(mysqli_query($con,$sql)){
    echo 1;

}else{
    echo 0;
}
?>