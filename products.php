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
        <!-- <span id="textfile"></span> -->
        <!-- <pre id="xml"></pre> -->
        <!-- <div id="product-container"></div> -->
        <div class="row products">
            <h1>Pagination</h1>
            <?php
            $conn = connectDB();
            $sql1 = "SELECT * FROM products";
            $page = isset($_GET['product_page']) ? $_GET['product_page'] : 1; // get the current page number
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();

            #get total records
            $total_records = $result1->num_rows;

            $records_per_page = 4;

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
            } else {
                echo "0 results";
            }
            echo "</div>";
            if ($total_pages > 1) {
                echo '<ul class="pagination pagination-lg justify-content-center">';
                $active = '';
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=products&product_page=' . $i . '">' . $i . '</a></li>';
                }
                echo '</ul>';
            }

            ?>


    </section>
    <section>
    <h1>Lazy loading</h1>

        <div class="container">

            <div class="list-group" id="lazy-load-list">
            </div>
        </div>
    </section>
</body>

</html>

<style>
    .product-price {
        font-size: 3rem;
        padding: 0;
        margin: 0;
        text-align: center;
        display: inline-block;
    }
    .page-link {
        padding: 0;
        width: 50px;
        text-align: center;
    }
</style>
<script>
    //pagination

    //lazyloading
    var current_page = 1; // set the current page to 1
    var loading = false; // flag to prevent multiple requests
    load_data(current_page);

    $(window).on('scroll', function() {
        // Calculate the bottom of the page
        var bottom_of_page = $(document).height() - $(window).height(); // adjust the offset to your liking

        if ($(window).scrollTop() >= bottom_of_page && !loading) {
            current_page++;
            load_data(current_page);
        }
    });

    function load_data(page) {
        loading = true;
        $.ajax({
            type: "GET",
            url: "./get_product.php",
            data: {
                product_page: page
            },
            success: function(response) {
                $('#lazy-load-list').append(response);
                // If there are no more records to load, hide the loading message
                if (response.trim() == '') {
                    $('.loading').hide();
                }

                loading = false; // set the loading flag to false
            }
        })
    };
</script>