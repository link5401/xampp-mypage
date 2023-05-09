<?php
require __DIR__ . '\DB.php';
$conn = connectDB();

$sql1 = "SELECT * FROM products";
$page = isset($_GET['product_page']) ? $_GET['product_page'] : 1; // get the current page number
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

#get total records
$total_records = $result1->num_rows;

$records_per_page = 7;

$offset = ($page - 1) * $records_per_page; // calculate the offset


$total_pages = ceil($total_records / $records_per_page);
$sql = "SELECT * FROM products LIMIT $offset,$records_per_page";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class ="product-price">' . $row['productName'] . ': ' . $row['price'] . '</div>';
    }
}