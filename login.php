<?php
session_start();
include("./config/config.php");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'logout') {
            session_unset();
            session_destroy();
        }
    }
}
$message = "";
if (isset($_COOKIE['useremail'])) {
    $loginuseremail = $_COOKIE['useremail'];
} else {
    $loginuseremail = "";
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
    if ($dbInfo->connect_error) {
        die("Connection error:" . $dbInfo->connect_error);
    }
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $selectQuery = "SELECT * FROM users WHERE 
            email='$email'";
    $result = $dbInfo->query($selectQuery);
    if ($result->num_rows > 0) {
        $cookieValue = "";
        while ($row = $result->fetch_assoc()) {
            //echo "id".$row['customer_id']." Name:".$row['customerName']." Email:".$row['email']." address:".$row['customerAddress'];
            $salt = $row['salt'];
            $password = $row['password'];
            $user_type = $row['user_type'];
            if (password_verify($pass . $salt, $password)) {
                $cookieValue = $row['email'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['user_id'] = $row['user_id'];
                if (isset($_POST['rememberme'])) {
                    if ($_POST['rememberme'] == "on") {
                        $cookieName = "useremail";
                        $cookieExp = time() + (86400 + 3);
                        setcookie($cookieName, $cookieValue, $cookieExp, "/");
                    }
                }
                if (!empty($_POST)) {
                    if ($user_type == "admin") {
                        header("location: ./admin/index.php");
                    } elseif ($user_type == "coach") {
                        header("location: ./coach/index.php");
                    } elseif ($user_type == "member") {
                        header("location: ./member/index.php");
                    } else {
                        echo "Invalid user";
                    }
                }
                exit;
            } else {
                $message = "Wrong email or password";
            }
        }
    } else {
        $message =  "Wrong email or password";
    }
    $dbInfo->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-9 p-0">
                <div class="card">
                    <img class="card-img" src="./img/common/tennis_club_cover.jpg" alt="cover">
                    <div class="card-img-overlay d-flex align-items-center">
                        <div>
                            <h2 class="text-white">Welcome to our club</h2>
                            <p class="text-white pt-3">Tennis is a sport you can do for a lifetime. <br> The earlier you start the better.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-center">
                <div class="p-5">
                    <h3 class="text-primary text-bold py-2">Tennis club management system</h3>
                    <h5 class="text-primary py-2">Welcome,<br> Let's get started</h5>
                    <p class="text-muted py-2">Please use your credentials to login. If you are not a member, please register. </p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <input type="email" class="form-control border-0 bg-light" name="email" id="InputEmail1" placeholder="Email" value="<?php echo $loginuseremail; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control bg-light border-0" id="InputPassword1" placeholder="Password">
                        </div>
                        <div class="text-danger"><?= $message ?></div>
                        <div class="mb-3">
                            <input type="checkbox" name="rememberme" id="rememberme"><span class="px-2">Remember me</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>