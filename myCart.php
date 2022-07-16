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
}else{

    $cart_query = "SELECT
    cart.cart_id,
    cart.customer_id,
    cart.product_id,
    products.product_name,
    products.product_brand,
    products.price
    FROM
    cart
    INNER JOIN products ON cart.cart_id = products.product_id
    WHERE
    cart.customer_id = '{$_SESSION['cus_id']}'";

    $result = mysqli_query($connection, $cart_query);

    if($result){

            $cartTable = "<table border=\"1\" cellpadding=\"20\" cellspacing=\"0\">";
            $cartTable .= "<tr>
                            <th>Product Brand</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            </tr>";
    
            while ($cart = mysqli_fetch_array($result)) {
    
                $cartTable .= "<td>" . $cart['product_brand'] . "</td>";
                $cartTable .= "<td>" . $cart['product_name'] . "</td>";
                $cartTable .= "<td>" . "$".$cart['price'] . "</td>";
                $cartTable .= "</tr>";
            }
    
            $cartTable .= "</table>";
        }

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="css/confirmPurchase.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
    <h1>My Cart</h1>
    <?php echo $cartTable; ?>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>