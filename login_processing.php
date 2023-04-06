<?php
session_start();
require __DIR__ . '\DB.php';
require __DIR__ . '\validate.php';


$conn = connectDB();
// $username = $password = "";
// $usernameErr = $passwordErr = "";
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // username
//     if (empty($_POST['username'])) {
//         $usernameErr = "username is required";
//     } else {
//         $username = test_input($_POST['username']);
//         // check if name only contains letters and whitespace
//         if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
//             $usernameErr = "Only letters and white space allowed";
//         }
//     }
//     // password
//     if (empty($_POST['password'])) {
//         $passwordErr = "password is required";
//     } else {
//         $password = test_input($_POST['password']);
//         if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
//             $passwordErr = 'the password must have 8 - 12 characters and contains at least 1 number and 1 letter';
//         }
//     }
// }


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

// if (isset($_SESSION['user'])) {
//     header('Location: index.php');
//     exit;
// } else {
//     header('Location: index.php?page=login');
//     exit;
// }
