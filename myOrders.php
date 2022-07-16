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
} else {

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

        $ordersTable = "<table border=\"1\" cellpadding=\"20\" cellspacing=\"0\">";
        $ordersTable .= "<tr>
                        <th>Product Brand</th>
                        <th>Product Name</th>
                        <th>Number of Units Placed</th>
                        <th>Total Price</th>
                        <th>Order Placed Date</th>
                        </tr>";

        while ($orders = mysqli_fetch_array($check_order_query)) {

            $ordersTable .= "<td>" . $orders['product_brand'] . "</td>";
            $ordersTable .= "<td>" . $orders['product_name'] . "</td>";
            $ordersTable .= "<td>" . $orders['order_qty'] . "</td>";
            $ordersTable .= "<td>" . $orders['order_price'] . "</td>";
            $ordersTable .= "<td>" . $orders['created_time'] . "</td>";
            $ordersTable .= "</tr>";
        }

        $ordersTable .= "</table>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="css/confirmPurchase.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
        <h1>My Orders</h1>
        <?php echo $ordersTable; ?>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>