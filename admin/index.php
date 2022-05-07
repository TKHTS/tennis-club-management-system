<?php
session_start();
include("../config/config.php");
include('./header.php');
?>
<main>
    <?php
    if (isset($_GET['p'])) {
        switch ($_GET['p']) {
            case "home":
                include('./pages/home.php');
                break;
            case "add_new_user":
                include('./pages/add_new_user.php');
                break;
            case "add_new_course":
                include('./pages/add_new_course.php');
                break;
            case "freeboard":
                include('./pages/freeboard.php');
                break;
            case "manage_notification":
                include('./pages/manage_notification.php');
                break;
        }
    } else {
        include('./pages/home.php');
    }
    ?>
</main>
<?php
include('./footer.php');
?>