<?php
include('./config.php');
$sqlCon = new mysqli($servername, $username, $password, $dbname);

if ($sqlCon->connect_error) {
    exit('DB Error');
}
$selectCommand = "SELECT * FROM courses";
$result = $sqlCon->query($selectCommand);
$output = "";
$arr = array();
while ($row = $result->fetch_assoc()) {
    $output .= "<div class='card col-6 p-5'><h4 class='card-title text-primary'>".$row['course_name'] . "</h4>" . $row['course_explanation'] . "<br></div>";
}

$sqlCon->close();
echo $output;
