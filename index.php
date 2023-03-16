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
</head>


<?php if (!isset($_SESSION['user'])) : ?>

    <body>

        <section>
            <ul class="nav-bar row px-0 g-0">
                <li class="col-3 px-0"><a href="?page=home">Home</a></li>
                <li class="col-3 px-0"><a href="?page=products">Products</a></li>
                <li class="col-3 px-0"><a href="?page=register">Register</a></li>
                <li class="col-3 px-0"><a href="?page=login">Login</a></li>
            </ul>
            </form>
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
                <li class="col-3 px-0"><a href="?page=home">Home</a></li>
                <li class="col-3 px-0"><a href="?page=products">Products</a></li>

                <li class="col-3 px-0"><a href="?page=logout">Logout</a></li>
                <li class="col-3 px-0" style="line-height:1"><a href="" style="pointer-events: none;">
                        <?php echo 'Username: ' . $_SESSION['user']; ?>
                        <?php echo '<br>Userlevel:' . $level; ?>
                    </a></li>
            </ul>
            </form>
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


</html>