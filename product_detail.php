<?php
require __DIR__ .  "\DB.php";

$id = $_GET["id"];
$conn = connectDB();
$query = "SELECT * from `products` WHERE productID = $id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo 'Product Name:' . $row["productName"];
        echo "<br>";
        echo 'Price:' . $row["price"];
    }
} else {
}
