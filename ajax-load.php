<?php
$con = mysqli_connect("localhost","root","","testing") or die("connection failed");

$limit_per_page = 5;
$page='';
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];

}else{
    $page = 1;
}
$offset = ($page - 1) * $limit_per_page;

$sql= "SELECT *FROM student LIMIT {$offset},{$limit_per_page}";
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

    $sql_total = "SELECT * FROM student";
    $records = mysqli_query($con,$sql_total) or die("query failed");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record/$limit_per_page);
    $output .= '<div id="pagination">';

    for($i=1; $i<=$total_pages; $i++){
        if($i == $page){
            $class = "active";
        }else{
            $class = "";
        }
        $output .= "<a class='{$class}'  id='{$i}' href=''>{$i}</a>";
    }
    $output .= "</div>";
    
    mysqli_close($con);
    echo $output;    
}else{
    echo "<h2>Record not found</h2>";
}
?>