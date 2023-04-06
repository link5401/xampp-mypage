<?php
require __DIR__ . "\DB.php";

$q = $_GET["q"];
$conn = connectDB();
$query = "SELECT * from `products` WHERE productName LIKE '%$q%'";
$result = $conn->query($query);
$product_names = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $product_names[] = $row;
    }
    echo json_encode($product_names);
}
