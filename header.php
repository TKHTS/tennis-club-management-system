<?php
session_start();
//Access pages by valid user
if (!isset($_SESSION['user_name'])) {
    session_destroy();
    header('Location: /tcms/login.php');
    exit;
} else {
    //Access only authorized pages 
    if ($_SESSION['user_type'] != $parent_dir) {
        $location = "/tcms/" . $_SESSION["user_type"] . "/index.php?p=not_found";
        header("Location: $location");
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="../css/style.css" rel="stylesheet">
    <title>TCMS</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 bg-primary min-vh-100 position-sticky d-flex justify-content-center py-5">
                <nav>
                    <h3 class="text-center text-white py-4">TCMS</h3>
                    <h4 class="text-white pt-5"><?php echo $_SESSION['user_name']; ?></h4>
                    <h5 class="text-white pb-4">ID: <?php echo $_SESSION['user_id'] . " / " . $_SESSION['user_type']; ?></h5>

                    <!-- Admin menu -->
                    <ul class="list-unstyled" <?php if ($parent_dir != "admin") {
                                                    echo "style='display:none;'";
                                                }; ?>>
                        <li class="my-2"><i class="bi bi-house-door text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=home">Home</a></li>
                        <li class="my-2"><i class="bi bi-person text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=add_new_user">Add new user</a></li>
                        <li class="my-2"><i class="bi bi-signpost text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=add_new_course">Add new course</a></li>
                        <li class="my-2"><i class="bi bi-clipboard text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=freeboard">Freeboard</a></li>
                        <li class="my-2"><i class="bi bi-bell text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=manage_notification">Manage notification</a></li>
                        <li><a class="text-white text-decoration-none" href="../login.php?error=logout">Log out</a></li>
                    </ul>

                    <!-- Coach menu -->
                    <ul class="list-unstyled" <?php if ($parent_dir != "coach") {
                                                    echo "style='display:none;'";
                                                }; ?>>
                        <li class="my-2"><i class="bi bi-house-door text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=home">Dashboard</a></li>
                        <li class="my-2"><i class="bi bi-bar-chart-steps text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=add_level_to_member">Add level to member</a></li>
                        <li class="my-2"><i class="bi bi-pen text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=edit_level_of_member">Edit level of member</a></li>
                        <li class="my-2"><i class="bi bi-clipboard text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=freeboard">Freeboard</a></li>
                        <li class="my-2"><a class="text-white text-decoration-none" href="../login.php?error=logout">Log out</a></li>
                    </ul>

                    <!-- Member menu -->
                    <ul class="list-unstyled" <?php if ($parent_dir != "member") {
                                                    echo "style='display:none;'";
                                                }; ?>>
                        <li class="my-2"><i class="bi bi-house-door text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=home">Home</a></li>
                        <li class="my-2"><i class="bi bi-list-ul text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=course_list">Course list</a></li>
                        <li class="my-2"><i class="bi bi-signpost-split text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=add_my_course">Add my course</a></li>
                        <li class="my-2"><i class="bi bi-clipboard text-white"></i><a class="px-4 text-white text-decoration-none" href="index.php?p=freeboard">Freeboard</a></li>
                        <li><a class="text-white text-decoration-none" href="../login.php?error=logout">Log out</a></li>
                    </ul>

                </nav>
            </div>
            <div class="col-9 p-4 bg-light">