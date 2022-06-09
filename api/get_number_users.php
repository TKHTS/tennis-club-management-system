<?php
include('./config.php');
$sqlCon = new mysqli($servername, $username, $password, $dbname);

if ($sqlCon->connect_error) {
    exit('DB Error');
}
$selectCommandCoach = "SELECT COUNT( user_name ) FROM users WHERE user_type = 'coach'";
$selectCommandMember = "SELECT COUNT( user_name ) FROM users WHERE user_type = 'member'";
$resultCoach = $sqlCon->query($selectCommandCoach);
$resultMember = $sqlCon->query($selectCommandMember);

$dataCoach = $resultCoach->fetch_column();
$dataMember = $resultMember->fetch_column();

$output = 
"<div class='card col-12 p-5'><h2 class='card-title text-primary'>Coach: " . $dataCoach . "</h2></div>" 
."<div class='card col-12 p-5'><h2 class='card-title text-primary'>Member: ". $dataMember . "</h2></div>";

$sqlCon->close();
echo $output;