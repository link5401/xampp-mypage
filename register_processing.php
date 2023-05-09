<?php
require __DIR__ . '\DB.php';
require __DIR__ . '\validate.php';


$conn = connectDB();
$username = $password = "";
$usernameErr = $passwordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username
    if (empty($_POST['username'])) {
        $usernameErr = "username is required";
    } else {
        $username = test_input($_POST['username']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }
    // password
    if (empty($_POST['password'])) {
        $passwordErr = "password is required";
    } else {
        $password = test_input($_POST['password']);
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            $passwordErr = 'the password must have 8 - 12 characters and contains at least 1 number and 1 letter';
        }
    }
}

if ($usernameErr != ""){
    echo $usernameErr;
} else if ($passwordErr != ""){
    echo $passwordErr;
} else {
    $hashedPw = md5($password);
    $query = "INSERT INTO users(username,password) VALUES('$username', '$hashedPw')";
    if($conn->query($query) === TRUE){
        echo 'Registered successfully';

    } else {
        echo "Error: ". $conn->error;
    }

}