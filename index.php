<?php
session_start();


require __DIR__ . '\DB.php';
$conn = connectDB();
createDB($conn);
createProductsTable($conn);
createUserTable($conn);
// insertUsr($conn, "linh", "123456",1);
// insertUsr($conn, "linh2", "123456",0);

// insertProduct($conn,"2B pencil","10$");
// insertProduct($conn,"4B pencil","10$");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mock Design</title>
    <link rel="shortcut icon" type="image/x-icon" href="yourLogo.jpg" />
    <link rel="stylesheet" href="./style.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>


<?php if (!isset($_SESSION['user'])) : ?>

    <body>

        <form>
            <label for="search-box">Search:</label>
            <input type="text" id="search-box">
        </form>
        <div id="search-results" style="display: block;"></div>
        <section>
            <ul class="nav-bar row px-0 g-0">
                <li class="col px-0"><a href="?page=home">Home</a></li>
                <li class="col px-0"><a href="?page=products">Products</a></li>
                <li class="col px-0"><a href="?page=register">Register</a></li>
                <li class="col px-0"><a href="?page=login">Login</a></li>
                <li class="col px-0"><a href="?page=google-map">Google Map</a></li>

            </ul>

        </section>

        <?php
        $page = isset($_GET["page"]) ? $_GET["page"] : 0;

        switch ($page) {
            case "login":
                include "login.php";
                break;
            case "register":
                include "register.php";
                break;

            case "products":
                include "products.php";
                break;

            case "home":
                include "home.php";

                break;
            case "google-map":
                include "google-map.php";

                break;
            default:
                include "home.php";
                break;
        };
        ?>
    </body>


<?php else : ?>

    <body>
        <?php $level = getUsrlevel($conn, $_SESSION['user']);  ?>
        <section>
            <ul class="nav-bar row px-0 g-0">
                <li class="col px-0"><a href="?page=home">Home</a></li>
                <li class="col px-0"><a href="?page=products">Products</a></li>
                <li class="col px-0"><a href="?page=google-map">Google map</a></li>

                <li class="col px-0"><a href="?page=logout">Logout</a></li>
                <li class="col px-0" style="line-height:1"><a href="" style="pointer-events: none;">
                        <?php echo 'Username: ' . $_SESSION['user']; ?>
                        <?php echo '<br>Userlevel:' . $level; ?>
                    </a></li>
            </ul>
            </form>
            <form id="search-main">
                <label for="search-box">Search:</label>
                <input type="text" id="search-box">
            </form>
            <div id="search-results" style="display: none;"></div>
        </section>

        <?php
        $page = isset($_GET["page"]) ? $_GET["page"] : 0;

        switch ($page) {
            case "login":
                include "login.php";
                break;
            case "register":
                include "register.php";
                break;
            case "logout":
                include "logout.php";
                break;
            case "products":
                include "products.php";
                break;
            case "google-map":
                include "google-map.php";

                break;
            case "home":
                include "home.php";

                break;
            default:
                include "home.php";
                break;
        };
        ?>
    </body>

<?php endif; ?>

<section>
        <footer class="my-footer">

            <div class="social">
                <a href="#">
                    <i class="icon ion-social-instagram"></i>
                </a>
                <a href="#">
                    <i class="icon ion-social-snapchat"></i>
                </a>
                <a href="#">
                    <i class="icon ion-social-twitter"></i>
                </a>
                <a href="#">
                    <i class="icon ion-social-facebook"></i>
                </a>
            </div>

            <ul class="row px-0 g-0">
                <li class="col-4 px-0"><a href="">Home</a></li>
                <li class="col-4 px-0"><a href="">Service</a></li>
                <li class="col-4 px-0"><a href="">Terms</a></li>
            </ul>
            <p class="copyright">Linh de Art © 2023</p>
        </footer>
    </section>
</html>

<script>
    var searchBox = document.getElementById("search-box");
    var searchResults = document.getElementById("search-results");
    searchBox.addEventListener("input", handleSearchBoxInput);

    function updateSearchResults(products) {
        searchResults.innerHTML = "";
        for (var i = 0; i < products.length; i++) {
            var product = products[i];
            var searchResultItem = document.createElement("a");
            searchResultItem.innerHTML = product.productName + "<br>";
            searchResultItem.setAttribute("href", "product_detail.php?id=" + product.productID);
            searchResults.appendChild(searchResultItem);
        }
        // Show the search results dropdown
        searchResults.style.display = "block";
    }



    function handleSearchBoxInput() {
        var query = searchBox.value.trim();

        // If the query is empty, hide the search results dropdown and return
        if (query === "") {
            searchResults.style.display = "none";
            return;
        }

        xhr1 = new XMLHttpRequest();
        xhr1.onreadystatechange = function() {
            if (xhr1.readyState == 4 && xhr1.status == 200) {
                // Parse the response as JSON
                console.log(xhr1.responseText);

                var products = JSON.parse(xhr1.responseText);
                // Update the search results dropdown
                updateSearchResults(products);
            }
        }
        xhr1.open("GET", "search.php?q=" + encodeURIComponent(query));
        xhr1.send();
    }
</script>