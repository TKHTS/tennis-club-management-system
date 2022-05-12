<h1>Member Dashboard</h1>
<?php
    $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
    if ($dbInfo->connect_error) {
        die("DB error: " . $dbInfo->connect_error);
    } else {

        //Delete user
        if(isset($_GET['delete_course_id'])){
            $deleteQuery = "DELETE FROM users WHERE user_id = ".$_GET['delete_course_id'];
            if($dbInfo->query($deleteQuery) === true){
                echo "<h2 class='text-success my-5'>Course successfully deleted</h2>";
            }else{
                echo $dbInfo->error;
            }
        }

        $user_id = $_SESSION['user_id'];
        // Read Courses
        $selectQuery = "SELECT * FROM registered_courses JOIN users ON registered_courses.coach_id = users.user_id JOIN courses ON registered_courses.course_id = courses.course_id WHERE member_id = $user_id ORDER BY courses.course_id ASC" ;
        $courses_list = $dbInfo->query($selectQuery);
        if ($courses_list->num_rows > 0) {
            echo "<h2 class='pt-4'>Courses</h2>";
            echo "<table class='w-100'><tr><th class='p-3'>ID</th><th>Name</th><th>Coach</th><th>Schedule</th><th>Course fee</th><th>Level</th></tr>";
            while ($course = $courses_list->fetch_assoc()) {
                echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $course['course_id'] . "</td><td class='p-1'>" . $course['course_name'] . "</td><td td class='p-1'>" . $course['user_name'] ."</td><td class='p-1'>" .$course['course_day_time'] ."</td><td class='p-1'> $ " .$course['course_fee'].
                    "</td><td class='p-1'>" .$course['level']."</td>" . "<td class='p-3'><a class='text-danger'". " onclick=\"return confirm('Are you sure?')\"". "href='" . $_SERVER['PHP_SELF'] . "?p=home&delete_course_id=" . $course['course_registration_id'] . "'>Delete</a></td></td></tr>";
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
                echo  "<div class='m-2 p-3 border-bottom'><p class='text-primary'>" . $edited_time ."</p><td class='p-1'>" .$notification['notification_text'].
                    "</div>";
            }
            echo "</div>";
        }



        $dbInfo->close();
    }

