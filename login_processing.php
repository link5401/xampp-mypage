<?php
require __DIR__ . '\DB.php';
$conn = connectDB();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT password FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["password"] == md5($password)) {

            setcookie("login_info", $value = "", time() + 86400, "/");
            $_SESSION['user'] = $username;
            echo "<br> Login sucessfully";
            ob_start();
            session_start();
            echo '<script type="text/javascript"> window.open("home.php","_self");</script>';            //  On Successful Login redirects to home.php

        } else {
            echo "<br> Incorrect username or password";
        }
    }
} else {
    echo "<br> Incorrect username or password";
}
