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

    $fav_query = "SELECT
    favorites.fav_id,
    favorites.customer_id,
    favorites.product_id,
    products.product_name,
    products.product_brand,
    products.price
    FROM
    favorites
    INNER JOIN products ON favorites.fav_id = products.product_id
    WHERE
    favorites.customer_id = '{$_SESSION['cus_id']}'";

    $result = mysqli_query($connection, $fav_query);

    if($result){

            $favTable = "<table border=\"1\" cellpadding=\"20\" cellspacing=\"0\">";
            $favTable .= "<tr>
                            <th>Product Brand</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            </tr>";
    
            while ($favorites = mysqli_fetch_array($result)) {
    
                $favTable .= "<td>" . $favorites['product_brand'] . "</td>";
                $favTable .= "<td>" . $favorites['product_name'] . "</td>";
                $favTable .= "<td>" . "$".$favorites['price'] . "</td>";
                $favTable .= "</tr>";
            }
    
            $favTable .= "</table>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites</title>
    <link rel="stylesheet" href="css/confirmPurchase.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
    <h1>My Favorites</h1>
    <?php echo $favTable; ?>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>