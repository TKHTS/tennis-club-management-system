<?php
include('./config.php');
// connect to the database
$sqlCon = new mysqli($servername, $username, $password, $dbname);

if ($sqlCon->connect_error) {
    exit('DB Error');
}
// select the notifications to display on the webpage from the database
$selectCommand = "SELECT * FROM notifications order by notification_id DESC";
$result = $sqlCon->query($selectCommand);
$output = "";
$arr = array();
while ($row = $result->fetch_assoc()) {
    $output .= 
    "<div class='card col-14 p-5'>
       <h4 class='card-title text-primary'>"
        .$row['notification_text'] . 
      "</h4>" 
        .$row['created_at'] . "
        <br>
    </div>";
}

// close the db connection
$sqlCon->close();
echo $output;