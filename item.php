<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

if (!isset($_GET['item_id'])) {
    echo "Product ID not passed!";
    // header('Location: home.php');
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

<?php
    echo "ID passed: ".$_GET['item_id'];
    // $id = $_GET['item_id'];

    $query = "SELECT * FROM products WHERE product_id = '{$_GET['item_id']}' LIMIT 1";

    $result = mysqli_query($connection, $query);

        if($result){ ?>
            <?php    while($record = mysqli_fetch_array($result)){ 
                $_GET['p_id'] = $record['product_id'];
                $prd_id = $record['product_id'];
                ?>

                    <p style="font-size:35px">
                        <?php echo $record['product_brand']." ".$record['product_name'] ?>
                        <a href="favFunction.php?item_id=<?=$_GET['p_id']?>">
                        <i class="fa fa-heart" style="font-size:35px;color:red"> </i>
                    </a> </p>
                    <div class="itemImg"><img src="assets/gt500.jpg"></div>
                    <div class="itemInfo">
                
                        <p>Brand: <?php echo $record['product_brand'] ?></p>
                        <p>Name: <?php echo $record['product_name'] ?></p>
                        <p>Price: <?php echo $record['price'] ?></p>
                        <p>Availability:<?php echo $record['qty'] ?> items available</p>

                    </div>

                    <div class="itemDesc">
                        <p>Description: <?php echo $record['product_description'] ?></p>
                    </div>

            <?php   }
                
        }

?>

</body>

</html>

<?php mysqli_close($connection); ?>