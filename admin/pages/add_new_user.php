<h1>Add new user</h1>
<div class="bg-white p-4 my-4">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>?p=add_new_user">
        <input class="form-control" type="text" name="username" placeholder="Name" required><br>
        <input class="form-control" type="email" name="email" placeholder="Email" required><br>
        <input class="form-control" type="tel" name="phone" placeholder="Phone" maxlength="11" required><br>
        <input class="form-control" type="password" name="pass" placeholder="password" required><br>
        <select class="form-select" name="user_type" required>
            <option value="admin">Admin</option>
            <option value="coach">Coach</option>
            <option value="member">Member</option>
        </select>
        <button class="my-4 btn btn-primary w-25" type="submit">Register</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $dbInfo = new mysqli($DBServer, $username, $password, $dbName);
        if ($dbInfo->connect_error) {
            die("Connection has problem:" . $dbInfo->connect_error);
        }
        $username = sanitize_input($_POST['username']);
        $email = sanitize_input($_POST['email']);
        $pass = sanitize_input($_POST['pass']);
        $phone = sanitize_input($_POST['phone']);
        $user_type = sanitize_input($_POST['user_type']);
        $salt = time();
        $password = password_hash($pass . $salt, PASSWORD_DEFAULT);

        //Check whehter the user account already exists or not
        $selectQuery = "SELECT * FROM users WHERE email = '$email'";
        $users_email = $dbInfo->query($selectQuery);
        if ($users_email->num_rows > 0) {
            echo "<h2 class='text-danger'>The user account already exists</h2>";
            return;
        }

        //Insert information
        $insertQuery = "INSERT INTO users 
        (user_name,email,phone,password,salt,user_type) VALUES('$username', '$email','$phone', '$password', '$salt', '$user_type')";
        if ($dbInfo->query($insertQuery) === true) {
            echo "<h2 class='text-success'>Registration successful</h2>";
        } else {
            echo "Error:" . $dbInfo->error;
        }
        $dbInfo->close();
    }
    ?>
</div>