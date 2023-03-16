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
        <?php
        getProducts($conn);
        ?>
        <section>

</body>

</html>