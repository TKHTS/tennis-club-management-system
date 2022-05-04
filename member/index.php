<?php
    include('./header.php');
?>
<main>
    <?php
        if(isset($_GET['p'])){
            switch($_GET['p']){
                case "home":
                    include ('./pages/home.php');
                break;
                case "add_my_course":
                    include('./pages/add_my_course.php');
                    break;
                case "freeboard":
                    include('./pages/freeboard.php');
                    break;
            }
        }else{
            include ('./pages/home.php');
        }
    ?>
</main>
<?php
    include('./footer.php');
?>