<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <h1>Home Page</h1>
    <p><a href="landing_page.php"> Go to Landing Page </a></p>

    <?php

    $query = "SELECT product_brand, product_name, price, qty, product_img FROM products";

    $result = mysqli_query($connection, $query);
    
    if ($result) {
        echo mysqli_num_rows($result) . " Records found!";

    if (mysqli_num_rows($result) > 0) {
        ?> <div class="gridContainer"> <?php
        while ($record = mysqli_fetch_array($result)) {
    ?>
            
            <a class="linkedPage" href="item.php">
                <div class="itemCard">

                    <img class="itemImage" src="assets/gt500.jpg" alt="Car">

                        <p class="itemName"><?php echo $record['product_brand'] ?></p>
                        <p class="itemBrand"><?php echo $record['product_name'] ?></p>
                        <p class="itemPrice"><strong> $<?php echo $record['price'] ?> </strong></p>
                        <p class="itemQty"><?php echo $record['qty'] ?> Items Available</p>
 
                    <button class="favBtn"> <i class="fa fa-heart" aria-hidden="true"></i> </button>

                </div>
            </a>

    <?php
        }
        ?></div><?php
    }

        }else{
            echo "DB failed!";
    }

    ?>

</body>

</html>

<?php mysqli_close($connection); ?>
