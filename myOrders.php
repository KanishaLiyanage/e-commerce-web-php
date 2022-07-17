<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

$p_id = " ";
$c_id = " ";
$t_price = " ";
$o_qty = " ";

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
    <title>My Orders</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
        <h1>My Orders</h1>
    </center>

<?php

    $orders_query = "SELECT
                     orders.order_id,
                     orders.customer_id,
                     orders.order_qty,
                     orders.order_price,
                     orders.created_time,
                     products.product_id,
                     products.product_name,
                     products.product_brand
                     FROM
                     orders
                     INNER JOIN products ON orders.order_id = products.product_id
                     WHERE orders.customer_id = '{$_SESSION['cus_id']}'";

    $check_order_query = mysqli_query($connection, $orders_query);

    if ($check_order_query) {
        echo mysqli_num_rows($check_order_query) . " Records found!";

        if (mysqli_num_rows($check_order_query) > 0) { ?>

            <div class="gridContainer">

                <?php while ($record = mysqli_fetch_array($check_order_query)) {

                    $_GET['p_id'] = $record['product_id'];

                ?>
                    <div>

                        <a class="linkedPage" href="item.php?item_id=<?= $_GET['p_id'] ?>">

                            <div class="itemCard">

                                <img class="itemImage" src="assets/gt500.jpg" alt="Car">

                                <p class="itemName"><?php echo $record['product_brand']." ".$record['product_name'] ?></p>
                                <p class="itemPrice"><strong> $<?php echo $record['order_price'] ?> </strong></p>
                                <p class="itemQty"><?php echo $record['order_qty'] ?> Items Available</p>

                            </div>

                        </a>

                        <a class="favBtn" href="favFunction.php?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-heart" style="font-size:25px"> </i></i> </a>

                    </div>

                <?php } ?>

        </div>

    <?php }
    } else {
        echo "DB failed!";
    }

?>

</body>

</html>

<?php mysqli_close($connection); ?>
