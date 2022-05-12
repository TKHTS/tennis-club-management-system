<h1>Admin Dashboard</h1>
<?php
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);
if ($dbInfo->connect_error) {
    die("DB error: " . $dbInfo->connect_error);
} else {

    //Update user
    if (isset($_POST['new_user_name']) && isset($_POST['new_user_name'])) {
        $new_user_id = $_POST['new_user_id'];
        $new_user_name = $_POST['new_user_name'];
        $new_user_email = $_POST['new_user_email'];
        $new_user_phone = $_POST['new_user_phone'];
        $new_user_type = $_POST['new_user_type'];
        $updateQuery = "UPDATE users SET user_name='$new_user_name', email = '$new_user_email', phone = '$new_user_phone', user_type = '$new_user_type' WHERE user_id=$new_user_id";
        if ($dbInfo->query($updateQuery) === true) {
            echo "<h2 class='text-success my-5'>User information successfully updated</h2>";
        } else {
            echo "$dbInfo->error";
        }
    }
    //Update course
    if (isset($_POST['new_course_name']) && isset($_POST['new_course_name'])) {
        $new_course_id = $_POST['new_course_id'];
        $new_course_name = $_POST['new_course_name'];
        $new_course_fee = $_POST['new_course_fee'];
        $new_course_coach = $_POST['new_course_coach'];
        $new_course_day_time = $_POST['new_course_day_time'];
        $new_course_explanation = $_POST['new_course_explanation'];
        $updateQuery = "UPDATE courses SET course_name='$new_course_name', course_fee = '$new_course_fee', course_coach = '$new_course_coach', course_day_time = '$new_course_day_time', course_explanation = '$new_course_explanation' WHERE course_id = $new_course_id";
        if ($dbInfo->query($updateQuery) === true) {
            echo "<h2 class='text-success my-5'>Course information successfully updated</h2>";
        } else {
            echo "$dbInfo->error";
        }
    }
    //Delete user
    if (isset($_GET['delete_user_id'])) {
        $deleteQuery = "DELETE FROM users WHERE user_id = " . $_GET['delete_user_id'];
        if ($dbInfo->query($deleteQuery) === true) {
            echo "<h2 class='text-success my-5'>User information successfully deleted</h2>";
        } else {
            echo $dbInfo->error;
        }
    }
    //Delete course
    if (isset($_GET['delete_course_id'])) {
        $deleteQuery = "DELETE FROM courses WHERE course_id = " . $_GET['delete_course_id'];
        if ($dbInfo->query($deleteQuery) === true) {
            echo "<h2 class='text-success my-5'>Course information successfully deleted</h2>";
        } else {
            echo $dbInfo->error;
        }
    }

    //Read user
    $selectQuery = "SELECT * FROM users ORDER BY user_id ASC";
    $users_list = $dbInfo->query($selectQuery);
    if ($users_list->num_rows > 0) {
        echo "<h2 class='pt-4'>Users</h2>";
        echo "<table class='w-100'><tr><th class='p-3'>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>User type</th></tr>";
        while ($user = $users_list->fetch_assoc()) {
            echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $user['user_id'] . "</td><td class='p-1'>" . $user['user_name'] . "</td><td td class='p-1'>" . $user['email'] . "</td><td td class='p-1'>" . $user['phone'] . "</td><td td class='p-3'>" . $user['user_type'] .
                "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?p=home&user_id=" . $user['user_id'] . "#edit_user_form" . "'>Edit</a></td>" . "<td class='p-3'><a class='text-danger'" . " onclick=\"return confirm('Are you sure?')\"" . "href='" . $_SERVER['PHP_SELF'] . "?p=home&delete_user_id=" . $user['user_id'] . "'>Delete</a></td></tr>";
        }
        echo "</table>";
    }

    //Display edit user form
    if (isset($_GET['user_id'])) {
        $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
        if ($dbInfo->connect_error) {
            echo "DB ERROR";
        } else {
            $id = $_GET['user_id'];
            $select = "SELECT * FROM users WHERE user_id = $id";
            $result = $dbInfo->query($select);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $userid = $user['user_id'];
                $username = $user['user_name'];
                $useremail = $user['email'];
                $userphone = $user['phone'];
                $usertype = $user['user_type'];
            }
            $dist_path = $_SERVER['PHP_SELF'] . "?p=home";

            echo "<form id='edit_user_form' class='bg-info p-4' method='POST' action='$dist_path' required>";
            echo "<h3 class='text-white'>Edit user</h3>";
            echo "<input class='form-control my-2' type='text' name='new_user_id' value='$userid' required readonly>";
            echo "<input class='form-control my-2' type='text' name='new_user_name' value='$username' required>";
            echo "<input class='form-control my-2' type='text' name='new_user_email' value='$useremail' required>";
            echo "<input class='form-control my-2' type='text' name='new_user_phone' value='$userphone' required>";
            echo "<select class='form-select my-2' name='new_user_type' required>" .
                "<option value='admin'";
            if ($usertype == 'admin') {
                echo ' selected';
            };
            echo ">Admin</option>" .
                "<option value='coach'";
            if ($usertype == 'coach') {
                echo ' selected';
            };
            echo ">Coach</option>" .
                "<option value='member'";
            if ($usertype == 'member') {
                echo ' selected';
            };
            echo ">Member</option>" .
                "</select>";
            echo "<button class='btn btn-primary w-25' type='submit' value='submit'>Edit</button>";
            echo "</form>";

        }
    }

    //Display edit course form
    if (isset($_GET['course_id'])) {
        $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
        if ($dbInfo->connect_error) {
            echo "DB ERROR";
        } else {
            $id = $_GET['course_id'];
            $select = "SELECT * FROM courses JOIN users ON courses.course_coach = users.user_id WHERE course_id = $id";
            $result = $dbInfo->query($select);
            if ($result->num_rows > 0) {
                $course = $result->fetch_assoc();
                $course_id = $course['course_id'];
                $course_name = $course['course_name'];
                $course_fee = $course['course_fee'];
                $course_coach = $course['course_coach'];
                $course_day_time = $course['course_day_time'];
                $course_explanation = $course['course_explanation'];

                $dist_path = $_SERVER['PHP_SELF'] . "?p=home";

                echo "<form id='edit_course_form' class='bg-info p-4' method='POST' action='$dist_path' required>";
                echo "<h3 class='text-white'>Edit course</h3>";
                echo "<p class='text-white m-0'>Course ID</p><input class='form-control my-2' type='text' name='new_course_id' value='$course_id' required readonly>";
                echo "<p class='text-white m-0'>Course name</p><input class='form-control my-2' type='text' name='new_course_name' value='$course_name' required>";
                echo "<p class='text-white m-0'>Fee</p><input class='form-control my-2' type='number' name='new_course_fee' value='$course_fee' required>";
                echo "<p class='text-white m-0'>Coach</p><select name='new_course_coach' class='form-select'>";
                $coach_select = "SELECT * FROM users WHERE user_type = 'coach'";
                $coach_result = $dbInfo->query($coach_select);
                while ($course = $coach_result->fetch_assoc()) {
                    echo "<option value='" . $course['user_id'] . "'";
                    if ($course_coach == $course['user_id']) {
                        echo ' selected';
                    };
                    echo ">" . $course['user_name'] . "</option>";
                }
                echo "</select>";
                echo "<p class='text-white m-0'>Day & Time</p><input class='form-control my-2' type='text' name='new_course_day_time' value='$course_day_time' required>";
                echo "<p class='text-white m-0'>Explanation</p><input class='form-control my-2' type='text' name='new_course_explanation' value='$course_explanation' required>";
                echo "<button class='btn btn-primary w-25 mt-4' type='submit' value='submit'>Edit</button>";
                echo "</form>";
            }
        }
    }

    // Read Courses
    $selectQuery = "SELECT * FROM courses JOIN users ON courses.course_coach = users.user_id ORDER BY course_id ASC";
    $courses_list = $dbInfo->query($selectQuery);
    if ($courses_list->num_rows > 0) {
        echo "<h2 class='pt-4'>Courses</h2>";
        echo "<table class='w-100'><tr><th class='p-3'>ID</th><th style='width: 15%;'>Name</th><th>Coach</th><th>Schedule</th><th style='width:10%;'>Fee</th><th style='width:15%;'>Explanation</th></tr>";
        while ($course = $courses_list->fetch_assoc()) {
            echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $course['course_id'] . "</td><td class='p-1'>" . $course['course_name'] . "</td><td td class='p-1'>" . $course['user_name'] . "</td><td class='p-1'>" . $course['course_day_time'] . "</td><td class='p-1'> $" . $course['course_fee'] . "</td><td class='p-2'> " . $course['course_explanation'] .
                "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?p=home&course_id=" . $course['course_id'] . "#edit_course_form" . "'>Edit</a></td>" . "<td class='p-3'><a class='text-danger'" . " onclick=\"return confirm('Are you sure?')\"" . "href='" . $_SERVER['PHP_SELF'] . "?p=home&delete_course_id=" . $course['course_id'] . "'>Delete</a></td></tr>";
        }
        echo "</table>";
    }

    // Read notification
    $selectQuery = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 5";
    $notifications_list = $dbInfo->query($selectQuery);
    if ($notifications_list->num_rows > 0) {
        echo "<h2 class='pt-4'>Notificaton</h2>";
        echo "<div class='w-100 bg-white p-2'>";
        while ($notification = $notifications_list->fetch_assoc()) {
            $edited_time = date('Y/m/d H:i',  strtotime($notification['created_at']));
            echo  "<div class='m-2 p-3 border-bottom'><p class='text-primary'>" . $edited_time . "</p><td class='p-1'>" . $notification['notification_text'] .
                "</div>";
        }
        echo "</div>";
    }



    $dbInfo->close();
}
