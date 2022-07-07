<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>

<?php

    if(isset($_POST['signup'])){

        $uname = mysqli_real_escape_string($connection, $_POST['username']);
        $umail = mysqli_real_escape_string($connection, $_POST['email']);
        $upw = mysqli_real_escape_string($connection, $_POST['pw']);
        $uno = mysqli_real_escape_string($connection, $_POST['number']);
        $uadr = mysqli_real_escape_string($connection, $_POST['address']);
        $upost = mysqli_real_escape_string($connection,$_POST['postalcode'] );
        $ucity = mysqli_real_escape_string($connection, $_POST['city']);
        $uprov = mysqli_real_escape_string($connection, $_POST['province']);
        $ucountry = mysqli_real_escape_string($connection, $_POST['country']);
        $uimg = mysqli_real_escape_string($connection, $_POST['image']);

        //$encrypted_password = sha1($upw);

        $query = "INSERT INTO customers(username, email, password, mobile_number, address, postal_code, city, province, country, image)
        VALUES ('{$uname}','{$umail}','{$upw}','{$uno}','{$uadr}','{$upost}','{$ucity}','{$uprov}','{$ucountry}','{$uimg}')";

        $result = mysqli_query($connection, $query);

        if($result){
            $customer = mysqli_fetch_assoc($result);
            $_SESSION['cus_id'] = $customer['customer_id'];
            $_SESSION['cus_username'] = $customer['username'];
            header("Location: home.php");
        }else{

        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <h1>Sign Up Page</h1>

    <form action="signup.php" method="POST">

        User Name: <input type="text" name="username" required>
        <br>
        Email: <input type="email" name="email" required>
        <br>
        Password: <input type="password" name="pw" required>
        <br>
        Mobile Number: <input type="text" name="number">
        <br>
        Residence Address: <input type="text" name="address">
        <br>
        Postal Code: <input type="text" name="postalcode">
        <br>
        City: <input type="text" name="city">
        <br>
        Province: <input type="text" name="province">
        <br>
        Country: <input type="text" name="country">
        <br>
        Upload your Image (only jpg accepted): <input type="file" name="image">
        <br>
        <input type="submit" name="signup" value="Sign Up and Continue">

    </form>

    <a href="signin.php"> back </a>

</body>

</html>

<?php mysqli_close($connection); ?>