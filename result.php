<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganpati Cosmetics</title>

    <!-- Font Awesome and Owl Carousel CDN links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="style.css">
    <style>
    .product {
        margin-top: 10%;
        width: 60%;
        height: 450px;
        margin: auto;
        text-align: center;
    }

    .product img {
        width: 50%;
        height: 100%;
    }

    .product h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .product p {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .product a {
        font-size: 1rem;
        color: #E1306C;
        text-decoration: none;
        border: 1px solid #E1306C;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>
</head>
<body>

<!-- Header section starts -->
<header>
    <div class="header-1">
        <a href="index.php" class="logo">
            <h1 style="background-color:#E1306C;color:white">Circuit Gear</h1>
        </a>
        
        <div class="col-md-6 offer">
            <a href="#" class="btn btn-success btn-sm">
                <?php
                if (!isset($_SESSION['customer_email'])) {
                    echo "Welcome Guest";
                } else {
                    echo "Welcome: " . $_SESSION['customer_email'];
                }
                ?>
            </a>
            <a id="pr" href="#">Shopping Cart Total Price: ₹ <?php totalPrice(); ?>, Total Items <?php item(); ?></a>
        </div>
    </div>

    <div class="header-2">
        <nav class="navbar">
            <ul>
                <li><a class="active" href="index.php">HOME</a></li>
                <li><a href="trimer.php">SHOP</a></li>
                <li><a href="contactus.php">CONTACT</a></li>
                <li><a href="#footer">ABOUT</a></li>
            </ul>

            <div class="col-md-6">
                <ul class="menu">
                    <li>
                        <div class="collapse clearfix" id="search">
                            <form class="navbar-form" method="get" action="result.php">
                                <div class="input-group">
                                    <input type="text" name="user_query" placeholder="search" class="form-control" required>
                                    <button type="submit" value="search" name="search" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> <span><?php item(); ?> items in cart</span></a></li>
                    <li><a href="customer_registration.php"><i class="fa fa-user-plus"></i> Register</a></li>
                    <li>
                        <?php
                        if (!isset($_SESSION['customer_email'])) {
                            echo "<a href='checkout.php'>My Account</a>";
                        } else {
                            echo "<a href='customer/my_account.php?my_order'>My Account</a>";
                        }
                        ?>
                    </li>
                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Goto Cart</a></li>
                    <li>
                        <?php
                        if (!isset($_SESSION['customer_email'])) {
                            echo "<a href='checkout.php'>Login</a>";
                        } else {
                            echo "<a href='logout.php'>Logout</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Header section ends -->

<!-- Search Results Section Starts -->

<?php
if (isset($_GET['user_query'])) {
    $search_query = $_GET['user_query'];
    $get_products = "SELECT * FROM products WHERE product_keyword LIKE '%$search_query%' OR product_title LIKE '%$search_query%'";
    $run_products = mysqli_query($con, $get_products);
    $count = mysqli_num_rows($run_products);

    if ($count == 0) {
        echo "<h2>No results found for '$search_query'</h2>";
    } else {
        echo "<h2>Search results for '$search_query'</h2>";
        while ($row_products = mysqli_fetch_array($run_products)) {
            $product_id = $row_products['product_id'];
            $product_title = $row_products['product_title'];
            $product_price = $row_products['product_price'];
            $product_image = $row_products['product_img1'];

            echo "
            <div class='product' style='margin-top: 100px;'>
                <h3>$product_title</h3>
                <img src='admin_area/product_images/$product_image' alt='$product_title'>
                <p><b>₹ $product_price</b></p>
                <a href='details.php?pro_id=$product_id'>Details</a>
            </div>
            ";
        }
    }
}
?>

<!-- Search Results Section Ends -->

<!-- Include other sections or footer here -->

</body>
</html>
