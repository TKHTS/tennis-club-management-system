<h1>Coach Dashboard</h1>
<?php
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);
if ($dbInfo->connect_error) {
    die("DB error: " . $dbInfo->connect_error);
} else {

    //Delete member from the course
    if (isset($_GET['delete_registration_course_member_id'])) {
        $deleteQuery = "DELETE FROM registered_courses WHERE course_registration_id = " . $_GET['delete_registration_course_member_id'];
        if ($dbInfo->query($deleteQuery) === true) {
            echo "<h2 class='text-success my-5'>Course successfully deleted</h2>";
        } else {
            echo $dbInfo->error;
        }
    }

    //Update course
    if (isset($_POST['new_course_registration_id'])) {
        $new_course_registration_id = $_POST['new_course_registration_id'];
        $new_registered_course_name = $_POST['new_registered_course_name'];
        $new_registered_course_level = $_POST['new_registered_course_level'];
        $updateQuery = "UPDATE registered_courses SET level = '$new_registered_course_level' WHERE course_registration_id = $new_course_registration_id";
        if ($dbInfo->query($updateQuery) === true) {
            echo "<h2 class='text-success my-5'>Course information successfully updated</h2>";
        } else {
            echo "$dbInfo->error";
        }
    }

    $user_id = $_SESSION['user_id'];

    //Read my members
    $selectQuery = "SELECT * FROM registered_courses JOIN users ON registered_courses.member_id = users.user_id JOIN courses ON registered_courses.course_id = courses.course_id WHERE coach_id = $user_id ORDER BY courses.course_id ASC";
    $courses_list = $dbInfo->query($selectQuery);
    if ($courses_list->num_rows > 0) {
        echo "<h2 class='pt-4'>My members</h2>";
        echo "<table class='w-100'><tr><th class='p-3'>ID</th><th>Name</th><th>Course</th><th>Level</th></tr>";
        while ($course = $courses_list->fetch_assoc()) {
            echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $course['user_id'] . "</td><td class='p-1'>" . $course['user_name'] . "</td>" . "<td class='p-1'>" . $course['course_name'] . "</td>" . "<td class='p-1'>" . $course['level']
                . "<td><a href='" . $_SERVER['PHP_SELF'] . "?p=home&registered_course_id=" . $course['course_registration_id'] . "#edit_course_form" . "'>Edit level</a></td>"
                . "</td><td class='p-3'><a class='text-danger'" . " onclick=\"return confirm('Are you sure?')\"" . "href='" . $_SERVER['PHP_SELF'] . "?p=home&delete_registration_course_member_id=" . $course['course_registration_id'] . "'>Delete</a></td></td></tr>";
        }
        echo "</table>";
    }

    //Display edit course form
    if (isset($_GET['registered_course_id'])) {
        $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
        if ($dbInfo->connect_error) {
            echo "DB ERROR";
        } else {
            $id = $_GET['registered_course_id'];
            $select = "SELECT * FROM registered_courses JOIN users ON registered_courses.member_id = users.user_id JOIN courses ON registered_courses.course_id = courses.course_id WHERE course_registration_id = $id";
            $result = $dbInfo->query($select);
            if ($result->num_rows > 0) {
                $registered_course = $result->fetch_assoc();
                $course_registration_id = $registered_course['course_registration_id'];
                $registered_course_name = $registered_course['course_name'];
                $registered_course_coach = $registered_course['course_coach'];
                $registered_course_member = $registered_course['user_name'];
                $registered_course_level = $registered_course['level'];

                $dist_path = $_SERVER['PHP_SELF'] . "?p=home";

                echo "<form id='edit_course_form' class='bg-info p-4' method='POST' action='$dist_path'>";
                echo "<h3 class='text-white'>Edit member level</h3>";
                echo "<p class='text-white m-0'>Course ID</p><input class='form-control my-2' type='text' name='new_course_registration_id' value='$course_registration_id' required readonly>";
                echo "<p class='text-white m-0'>Course name</p><input class='form-control my-2' type='text' name='new_registered_course_name' value='$registered_course_name' required readonly>";
                echo "<p class='text-white m-0'>Course coach ID</p><input class='form-control my-2' type='number' name='new_registered_course_coach' value='$registered_course_coach' readonly required>";
                echo "<p class='text-white m-0'>Member name</p><input class='form-control my-2' type='text' name='new_registered_course_member' value='$registered_course_member' readonly required>";
                echo "<p class='text-white m-0'>Level</p><select name='new_registered_course_level' class='form-select'>";
                echo "<option value='beginner'";
                if ($registered_course_level == 'beginner') {
                    echo ' selected';
                };
                echo ">beginner</option>";
                echo "<option value='mid'";
                if ($registered_course_level == 'mid') {
                    echo ' selected';
                };
                echo ">mid</option>";
                echo "<option value='advanced'";
                if ($registered_course_level == 'advanced') {
                    echo ' selected';
                };
                echo ">advanced</option>";
                echo "</select>";
                echo "<button class='btn btn-primary w-25 mt-4' type='submit' value='submit'>Edit</button>";
                echo "</form>";
            }
        }
    }

    // Read my courses
    $selectQuery = "SELECT * FROM registered_courses JOIN users ON registered_courses.member_id = users.user_id JOIN courses ON registered_courses.course_id = courses.course_id WHERE coach_id = $user_id ORDER BY courses.course_id ASC";
    $courses_list = $dbInfo->query($selectQuery);
    if ($courses_list->num_rows > 0) {
        echo "<h2 class='pt-4'>My courses</h2>";
        echo "<table class='w-100'><tr><th class='p-3'>ID</th><th>Name</th><th>Schedule</th><th>Fee</th></tr>";
        while ($course = $courses_list->fetch_assoc()) {
            echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $course['course_id'] . "</td><td class='p-1'>" . $course['course_name'] . "</td><td class='p-1'>" . $course['course_day_time'] . "</td><td class='p-1'> $ " . $course['course_fee'] .
                "</td>" . "</tr>";
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
