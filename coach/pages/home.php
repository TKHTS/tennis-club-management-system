<?php session_start();
// if (!isset($_SESSION['customerName'])) {
//     session_destroy();
//     header('Location: customerLogin.php');
//     exit;
// }
?>

<h1>Dashboard | Coach</h1>
<?php
echo "welcome " . $_SESSION['user_name'];
?>