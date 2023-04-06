<?php
require __DIR__ . '\DB.php';
$conn = connectDB();
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$xmlDoc = new DOMDocument();
$productsNode = $xmlDoc->createElement("products");
$xmlDoc->appendChild($productsNode);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $productNode = $xmlDoc->createElement("product");
        $productNode->setAttribute("productID",$row["productID"]);
        $nameNode = $xmlDoc->createElement("productName");
        $nameNode->appendChild($xmlDoc->createTextNode($row["productName"]));
        $priceNode = $xmlDoc->createElement("price");
        $priceNode->appendChild($xmlDoc->createTextNode($row["price"]));

        $productNode->appendChild($nameNode);
        $productNode->appendChild($priceNode);
        $productsNode->appendChild($productNode);

    }
    header("Content-type: text/xml");
    echo $xmlDoc->saveXML();
} else {
    echo "0 results";
}
