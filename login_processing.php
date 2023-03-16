<?php
session_start();
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

         

        } else {
            echo "<br> Incorrect username or password";
        }
    }
} else {
    echo "<br> Incorrect username or password";
}
if(isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
} else {
    header('Location: index.php?page=login');
    exit;
}