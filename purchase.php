<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

$p_id = " ";
$c_id = " ";

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

if (isset($_GET['item_id'])) {
    echo "ID passed!";
} else {
    echo "ID pass failed!";
}

?>

<?php

if(isset($_POST['submit'])){
    $cus_qty = mysqli_real_escape_string($connection, $_POST['qty']);

    $t_price = $p_price * $cus_qty;

    echo $t_price;
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

    <h1>Purchase Page</h1>

    <?php

    $p_id = $_GET['item_id'];
    $c_id = $_SESSION['cus_id'];

    $query = "SELECT * FROM products WHERE product_id = '{$p_id}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {

        while ($record = mysqli_fetch_array($result)) {

            $id = $record['product_id'];
            $p_brand = $record['product_brand'];
            $p_name = $record['product_name'];
            $p_qty = $record['qty'];
            $p_price = $record['price'];
    ?>
            <p><?php echo $id; ?></p>
            <p><?php echo $p_brand." ".$p_name; ?></p>
            <p><?php echo $p_qty; ?></p>
            <p><?php echo $p_price; ?></p>

    <?php
        }
    }

    ?>

    <form action="purchase.php" method="POST">
        <input type="text" name="qty">
        <input type="submit" name="submit">
    </form>

    <P>Total Price: </P>

</body>

</html>

<?php mysqli_close($connection); ?>