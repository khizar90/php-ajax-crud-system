<?php
$con = mysqli_connect("localhost","root","","testing") or die("connection failed");

$sql= "SELECT *FROM student";
$result= mysqli_query($con,$sql) or die("query failder");
$output = "";
if(mysqli_num_rows($result) > 0){
    $output = '<table border= "1px" width = "100%" cellpadding = "10px" cellspacing= "0">
    <tr>
       <th width="100px">Id</th>
       <th>Name</th>
       <th width="100px">Delete</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr><td>{$row['id']}</td><td>{$row['first name']} {$row['last name5']}</td><td><button class='delete-btn' data-id='{$row['id']}'>Delete</button></td></tr>";
    }
    $output .= "</table>";
    mysqli_close($con);
    echo $output;    
}else{
    echo "<h2>Record not found</h2>";
}
?>