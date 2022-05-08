<h1>Course list</h1>
<?php

$dbInfo = new mysqli($DBServer, $username, $password, $dbName);
if ($dbInfo->connect_error) {
    echo "DB ERROR";
} else {
    // Read Courses
    $selectQuery = "SELECT * FROM courses JOIN users ON courses.course_coach = users.user_id ORDER BY course_id ASC";
    $courses_list = $dbInfo->query($selectQuery);
    if ($courses_list->num_rows > 0) {
        echo "<table class='w-100'><tr><th class='p-3'>ID</th><th>Name</th><th>Coach</th><th>Schedule</th><th>Fee</th><th class='w-25'>Explanation</th></tr>";
        while ($course = $courses_list->fetch_assoc()) {
            echo "<tr class='bg-white border-5 border-light rounded-3'><td class='p-3'>" . $course['course_id'] . "</td><td class='p-1 text-break w-25'>" . $course['course_name'] . "</td><td td class='p-1 text-break'>" . $course['user_name'] . "</td><td class='p-1'>" . $course['course_day_time'] . "</td><td class='p-1'> $" . $course['course_fee'] .
                "</td><td class='text-break'>".$course['course_explanation']."</td></tr>";
        }
        echo "</table>";
    }

    $dbInfo->close();
}
