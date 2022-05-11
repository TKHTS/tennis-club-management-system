<h1>Freeboard</h1>
<?php
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);

if ($dbInfo->connect_error) {
  die("DB error: " . $dbInfo->connect_error);
} else {

  // Write Process
  if (isset($_POST['content'])) {
    $userName = $_SESSION['user_name'];
    //Sanitize text data and add break
    $postText = nl2br(htmlspecialchars($_POST['content']));
    $insertQuery = "INSERT INTO freeboard_posts(writer,post_text) VALUES('$userName', '$postText')";
    if ($dbInfo->query($insertQuery) === true) {
        // Avoid duplicate post
        echo <<<EOF
        <script>
            location.href='./index.php?p=freeboard';
        </script>
        EOF;
    } else {
        echo "Error:" . $dbInfo->error;
    }
  }

  // List
  $selectQuery = "SELECT * FROM freeboard_posts ORDER BY post_id DESC";
  $postList = $dbInfo->query($selectQuery);
  if ($postList->num_rows > 0) {

      echo "<div class='w-100'>";

      while ($post = $postList->fetch_assoc()) {

        echo "<div class='bg-white border-5 border-light rounded-3 m-2 p-3'>
        <span class='p-3 text-primary'>". $post['writer'] ."</span>
        <span class='p-3 mr-auto'>". $post['created_at'] . "</span>
        <div class='p-3'>". $post['post_text']."</div>"."</div>";
      }
      echo "</div>";     
      

    } else {
    echo "No contents";
  }

  // write form 
  $path = $_SERVER['PHP_SELF']."?p=freeboard";

  echo "<form name='writeForm' method='POST' action='".$path."'>
          <textarea class='form-control' name='content' cols='80' rows='10' required></textarea>
          <br>
          <br>
          <button type='submit' class='btn btn-primary' value='Save'>Save</button>
      </form>";

}

$dbInfo->close();

?>
