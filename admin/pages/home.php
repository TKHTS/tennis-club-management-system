<?php session_start();
// if (!isset($_SESSION['customerName'])) {
//     session_destroy();
//     header('Location: customerLogin.php');
//     exit;
// }
?>

<h1>Admin Home page</h1>
<?php
echo "welcome " . $_SESSION['user_name'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['logoutbtn'] == 'logout') {
                session_unset();
                session_destroy();
                header('Location: customerLogin.php');
                exit;
            }
        }
?>