<h1>Manage notification</h1>
<?php
  $dbInfo = new mysqli($DBServer, $username, $password, $dbName);

  $path = $_SERVER['PHP_SELF']."?p=manage_notification";
  $postId = "";
  $getContent = ""; // for Edit

  if ($dbInfo->connect_error) {
    die("DB error: " . $dbInfo->connect_error);
  } else {

  // Write Process
  if (isset($_GET['w'])) {
        //Sanitize text data and add break
        $postText = nl2br(htmlspecialchars($_POST['content']));
        $insertQuery = "INSERT INTO notifications(notification_text) VALUES('$postText')";
    if ($dbInfo->query($insertQuery) === true) {
        // Avoid duplicate post
        echo <<<EOF
        <script>
            location.href='./index.php?p=manage_notification';
        </script>
        EOF;
    } else {
        echo "Error:" . $dbInfo->error;
    }
  }

  // Select content for Update
  if (isset($_GET['enId']) && !isset($_GET['u'])) {
    $postId = $_GET['enId'];
    $selectQuery = "SELECT notification_text FROM notifications WHERE notification_id = '$postId'";
    $getContentData = $dbInfo->query($selectQuery);
    $getContent = $getContentData->fetch_assoc();
    $getContent = $getContent['notification_text'] === null ? '' : $getContent['notification_text'];
    //Delete unnecessary linefeed code
    $getContent = str_replace(array("\r\n", "\r", "\n", ""), "", $getContent);
    //Display html tag as html inside textarea
    $getContent = str_replace("<br />", "&#13", $getContent);
  }

  // Update Process
  if (isset($_GET['enId']) && isset($_GET['u'])) {
    //Sanitize text data and add break
    $postText = nl2br(htmlspecialchars($_POST['content']));
    //Delete unnecessary linefeed code
    $postText = str_replace(array("\r\n", "\r", "\n"), "", $postText);
    $postId = $_GET['enId'];
    $updateQuery = "UPDATE notifications SET notification_text='$postText' WHERE notification_id = '$postId'";
    if ($dbInfo->query($updateQuery) === true) {
        // Avoid duplicate post
        echo <<<EOF
        <script>
            location.href='./index.php?p=manage_notification';
        </script>
        EOF;
    } else {
        echo "Error:" . $dbInfo->error;
    }
  }

  // Delete Process
  if (isset($_GET['dnId'])) {
    $postId = $_GET['dnId'];
        $deleteQuery = "DELETE FROM notifications WHERE notification_id = '$postId'";
    if ($dbInfo->query($deleteQuery) === true) {
    } else {
        echo "Error:" . $dbInfo->error;
    }
  }

  

  // notification
  $selectQuery = "SELECT * FROM notifications ORDER BY notification_id DESC";
  $notifications_list = $dbInfo->query($selectQuery);
  if ($notifications_list->num_rows > 0) {
      echo "<table class='w-100 bg-white p-2' >";
      while ($notification = $notifications_list->fetch_assoc()) {
          $edited_time = date('Y/m/d H:i',  strtotime($notification['created_at']));
          echo "<tr>";
          echo    "<td class='m-2 p-3 text-primary'>" . $edited_time . "</td>" . 
                  "<td class='m-2 p-3'><a href='".$path."&enId=".$notification['notification_id']."' >Edit</a></td>";
                  "</tr>";
                  echo "<tr>";
                  echo    "<td class='m-2 p-3 border-bottom'>" .$notification['notification_text']  . "</td>" . 
                  "<td class='m-2 p-3 border-bottom'><a class='text-danger' href='".$path."&dnId=".$notification['notification_id']."'>Delete</a></td>";
                "</tr>";
      }
      echo "</table>";
  }


  if ($getContent) $path = $path."&u=true&enId=".$postId;
  else $path = $path."&w=true";

  // write form
  echo "<form name='writeForm' method='POST' action='".$path."'>
          <textarea class='form-control' name='content' cols='80' rows='10' required>".$getContent."</textarea>
          <br>
          <br>
          <button type='submit' class='btn btn-primary' value='Save'>Save</button>
      </form>";

  }

  $dbInfo->close();

?>