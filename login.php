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
            <div class="col-8 p-0">
                <div class="card">
                    <img class="card-img" src="./img/common/tennis_club_cover.jpg" alt="cover">
                    <div class="card-img-overlay d-flex align-items-center">
                        <div>
                            <h2 class="text-white">Welcome to our club</h2>
                            <p  class="text-white pt-3">Tennis is a sport you can do for a lifetime. <br> The earlier you start the better.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="p-5">
                    <h3 class="text-primary text-bold py-2">Tennis club management system</h3>
                    <h5 class="text-primary py-2">Welcome Let's get started</h5>
                    <p class="text-muted py-2">Please use your credentials to login. If you are not a member, please register. </p>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control border-0 bg-light" id="InputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control bg-light border-0" id="InputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <p class="mt-4">The section below is for testing ↓</p>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <select name="usertype">
                            <option value="admin">admin</option>
                            <option value="coach">coach</option>
                            <option value="member">member</option>
                        </select>
                        <input type="submit" name="login" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php

    //Redirect to index page according to usertype
    if (!empty($_POST)) {
        if (($_POST["usertype"]) == "admin") {
            header("location: ./admin/index.php");
        } elseif ($_POST["usertype"] == "coach") {
            header("location: ./coach/index.php");
        } elseif ($_POST["usertype"] == "member") {
            header("location: ./member/index.php");
        } else {
            echo "Invalid user";
        }
    }
    ?>

</body>

</html>