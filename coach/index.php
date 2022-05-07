<?php
$parent_dir = basename(dirname(__FILE__));
include("../config/config.php");
include('../header.php');
?>
<main>
    <?php
    if (isset($_GET['p'])) {
        switch ($_GET['p']) {
            case "home":
                include('./pages/home.php');
                break;
            case "add_level_to_member":
                include('./pages/add_level_to_member.php');
                break;
            case "edit_level_of_member":
                include('./pages/edit_level_of_member.php');
                break;
            case "freeboard":
                include('./pages/freeboard.php');
                break;
            case "not_found":
                include('../404.php');
                break;
        }
    } else {
        include('./pages/home.php');
    }
    ?>
</main>
<?php
include('../footer.php');
?>