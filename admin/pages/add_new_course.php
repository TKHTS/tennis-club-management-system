<h1>Add new course</h1>

<?php
$dist_path = $_SERVER['PHP_SELF'] . "?p=add_new_course";
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);
if ($dbInfo->connect_error) {
    die("Connection has problem:" . $dbInfo->connect_error);
}
$selectQuery = "SELECT * FROM users WHERE user_type = 'coach'";
$coaches_list = $dbInfo->query($selectQuery);
if ($coaches_list->num_rows > 0) {
    echo "<form id='edit_form' class='bg-white p-4' method='POST' action='$dist_path' required>";
    echo "<h3 class='text-white'>Edit user</h3>";
    echo "<input class='form-control my-2' type='text' name='course_name' placeholder='Course name' required>";
    echo "<input class='form-control my-2' type='text' name='course_fee' placeholder='Course fee' required>";
    echo "<select name='course_coach' class='form-select'>";
    while ($coach = $coaches_list->fetch_assoc()) {
        echo "<option value='" . $coach['user_id'] . "'>" . $coach['user_name'] . "</option>";
    }
    echo "</select>";
    echo "<input class='form-control my-2' type='text' name='course_day_time' placeholder='Day & Time ' required>";
    echo "<input class='form-control my-2' type='text' name='course_explanation' placeholder='Explanation ' required>";
    echo "<button class='btn btn-primary w-25' type='submit' value='submit'>Register</button>";
    echo "</form>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
    if ($dbInfo->connect_error) {
        die("Connection has problem:" . $dbInfo->connect_error);
    }
    $course_name = sanitize_input($_POST['course_name']);
    $course_fee = sanitize_input($_POST['course_fee']);
    $course_coach = sanitize_input($_POST['course_coach']);
    $course_day_time = sanitize_input($_POST['course_day_time']);
    $course_explanation = sanitize_input($_POST['course_explanation']);

    //Check whehter the course already exists or not
    $selectQuery = "SELECT * FROM courses WHERE course_name = '$course_name'";
    $users_email = $dbInfo->query($selectQuery);
    if ($users_email->num_rows > 0) {
        echo "<h2 class='text-danger'>The course already exists</h2>";
        return;
    }

    //Insert information
    $insertQuery = "INSERT INTO courses 
        (course_name,course_fee,course_coach,course_day_time,course_explanation) VALUES('$course_name', '$course_fee','$course_coach', '$course_day_time', '$course_explanation')";
    if ($dbInfo->query($insertQuery) === true) {
        echo "<h2 class='text-success'>Registration successful</h2>";
    } else {
        echo "Error:" . $dbInfo->error;
    }
    $dbInfo->close();
}
?>
</div>