<?php


function connectDB()
{
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "OnlineStore";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return;
    }
    // echo "Connected successfully\n";
    return $conn;
}

function createDB($conn)
{
    $sql = "CREATE DATABASE IF NOT EXISTS OnlineStore;";
    if ($conn->query($sql) == True) {
        // echo "Successfully created Online Store\n";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}

function createProductsTable($conn)
{
    $sql = "CREATE TABLE IF NOT EXISTS products (
        productID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        productName varchar(255),
        price int
    )";
    if ($conn->query($sql) == True) {
        // echo "Successfully created product table\n";
    } else {
        echo "Error creating prduct table: " . $conn->error;
    }
}

function createUserTable($conn)
{
    $sql = "CREATE TABLE IF NOT EXISTS users (
        userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username varchar(255),
        password varchar(255),
        usrlevel INT(6)
    )";
    if ($conn->query($sql) == True) {
        // echo "Successfully created usr table\n";
    } else {
        echo "Error creating usr table: " . $conn->error;
    }
}

function insertProduct($conn, $name, $price)
{
    $sql = "INSERT INTO products (productName, price)
VALUES ('$name', '$price')";

    if ($conn->query($sql) == True) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function insertUsr($conn, $username, $password, $level)
{
    $password = md5($password);
    $sql = "INSERT INTO users (username, password, usrlevel)
VALUES ('$username', '$password', '$level')";
    if ($conn->query($sql) == True) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function getUsrlevel($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            return $row['usrlevel'];
        }
    } else {
        echo "0 results";
    }
    
}



function getProducts($conn)
{
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<br>" . "id: " . $row["productID"] . " - Name: " . $row["productName"] . " " . $row["price"];
        }
    } else {
        echo "0 results";
    }
}
