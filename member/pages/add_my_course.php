<h1>Add my course</h1>

<?php
$dist_path = $_SERVER['PHP_SELF'] . "?p=add_my_course";
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);
if ($dbInfo->connect_error) {
    die("Connection has problem:" . $dbInfo->connect_error);
}
$selectQuery = "SELECT * FROM courses";
$coursees_list = $dbInfo->query($selectQuery);
if ($coursees_list->num_rows > 0) {
    echo "<form id='edit_form' class='bg-white p-4' method='POST' action='$dist_path' required>";
    echo "<h3 class='text-white'>Edit user</h3>";
    echo "<select name='select_course' class='form-select'>";
    while ($course = $coursees_list->fetch_assoc()) {
        echo "<option value='" . $course['course_id'] . "'>" . $course['course_name'] . "</option>";
    }
    echo "</select>";
    echo "<button class='btn btn-primary w-25' type='submit' value='submit'>Register</button>";
    echo "</form>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $course_id = sanitize_input($_POST['select_course']);
    $member_id = $_SESSION['user_id'];
    $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
    if ($dbInfo->connect_error) {
        die("Connection has problem:" . $dbInfo->connect_error);
        }else{

    $selectQuery = "SELECT * FROM courses WHERE course_id = '$course_id'";
    $users_email = $dbInfo->query($selectQuery);
    if ($users_email->num_rows > 0) {
        while ($course = $users_email->fetch_assoc()) {
            $coach_id = $course['course_coach'];
        }
    }

    $insertQuery = "INSERT INTO registered_courses 
        (course_id,coach_id,member_id) VALUES('$course_id', '$coach_id','$member_id')";
    if ($dbInfo->query($insertQuery) === true) {
        echo "<h2 class='text-success'>Registration successful</h2>";
    } else {
        echo "Error:" . $dbInfo->error;
    }
    $dbInfo->close();
}
}

?>
</div>