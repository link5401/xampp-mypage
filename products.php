<html lang="en">

<head>
    <title>Products</title>
    <link rel="shortcut icon" type="image/x-icon" href="yourLogo.jpg" />
    <link rel="stylesheet" href="./style.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    <section>
        <h1>product</h1>
        <br>
        <br>
        <span id="textfile"></span>
        <pre id="xml"></pre>
        <!-- <div id="product-container"></div> -->
    </section>

</body>

</html>

<script>
    var textfile = document.getElementById("textfile");
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = function() {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            textfile.innerHTML = xhr1.responseText;
        }
    };
    xhr1.open("GET", "text.txt");

    xhr1.send();

    var xml = document.getElementById("xml");
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            var xmlDoc = this.responseText;
            console.log(xmlDoc);
            xml.innerHTML = xmlDoc;
            // var products = xmlDoc.getElementsByTagName("products")[0];
            // var productNodes = products.getElementsByTagName("product");
            // for (var i = 0; i < productNodes.length; i++) {
            //     var product = productNo  des[i];

            //     var productID = document.createElement("p");
            //     productID.innerHTML = product.getAttribute("productID");

            //     var productName = document.createElement("p");
            //     productID.innerHTML = product.getElementsByTagName("productName")[0].childNodes[0].nodeValue;

            //     var price = document.createElement("p");
            //     price.innerHTML = product.getElementsByTagName("price")[0].childNodes[0].nodeValue;

            //     var productContainer = document.getElementById("product-container");
            //     productContainer.appendChild(productID);
            //     productContainer.appendChild(productName);
            //     productContainer.appendChild(price);
        }
    }

    xhr2.open("GET", "get_product.php");
    xhr2.send();
</script>