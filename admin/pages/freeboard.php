<h1>Freeboard</h1>
<?php
$dbInfo = new mysqli($DBServer, $username, $password, $dbName);

if ($dbInfo->connect_error) {
  die("DB error: " . $dbInfo->connect_error);
} else {

  // Write Process
  if (isset($_GET['write'])) {
    $userName = $_SESSION['user_name'];
    $postText = $_POST['content'];
    $insertQuery = "INSERT INTO freeboard_posts(writer,post_text) VALUES('$userName', '$postText')";
    if ($dbInfo->query($insertQuery) === true) {
      // redirection code
    } else {
        echo "Error:" . $dbInfo->error;
    }
    
  }

  // List
  $selectQuery = "SELECT * FROM freeboard_posts ORDER BY post_id DESC";
  $postList = $dbInfo->query($selectQuery);
  if ($postList->num_rows > 0) {

      echo "<table class='w-100'>";

      while ($post = $postList->fetch_assoc()) {

        echo "<tr class='bg-white border-5 border-light rounded-3'>
        <td class='p-1'>". $post['writer'] ."</td>
        <td class='p-1'>". $post['created_at'] . "</td>
        </tr >
              <tr>
              <td class='p-1' colspan='2'>" . $post['post_text'] . "</td>
              </tr>";
      }
      echo "</table>";     
      

    } else {
    echo "No contents";
  }

  // write form 
  $path = $_SERVER['PHP_SELF']."?p=freeboard&write=true";

  echo "<form name='writeForm' method='POST' action='".$path."'>
          <textarea class='form-control' name='content' cols='80' rows='10' required></textarea>
          <br>
          <br>
          <input type='submit' value='Save'>
      </form>";

}

$dbInfo->close();

?>
