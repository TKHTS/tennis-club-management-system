<h1>Manage notification</h1>
<?php
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);

if ($dbInfo->connect_error) {
  die("DB error: " . $dbInfo->connect_error);
} else {

 // Write Process
 if (isset($_GET['write'])) {
  $postText = $_POST['content'];
  $insertQuery = "INSERT INTO notifications(notification_text) VALUES('$postText')";
  if ($dbInfo->query($insertQuery) === true) {
    // redirection code
  } else {
      echo "Error:" . $dbInfo->error;
  }
}

// notification
    $selectQuery = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 5";
    $notifications_list = $dbInfo->query($selectQuery);
    if ($notifications_list->num_rows > 0) {
        echo "<div class='w-100 bg-white p-2'>";
        while ($notification = $notifications_list->fetch_assoc()) {
            $edited_time = date('Y/m/d H:i',  strtotime($notification['created_at']));
            echo  "<div class='m-2 p-3 border-bottom'><p class='text-primary'>" . $edited_time . "</p><td class='p-1'>" . $notification['notification_text'] .
                "</div>";
        }
        echo "</div>";
    }

  // write form
  $path = $_SERVER['PHP_SELF']."?p=manage_notification&write=true";

  echo "<form name='writeForm' method='POST' action='".$path."'>
          <textarea class='form-control' name='content' cols='80' rows='10' required></textarea>
          <br>
          <br>
          <input type='submit' value='Save'>
      </form>";

  }

    $dbInfo->close();

    ?>