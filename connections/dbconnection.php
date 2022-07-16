<?php 

    //e-commerce-website
    //admin_portal
    $connection = mysqli_connect('localhost','root','','e-commerce-website');

    if(mysqli_connect_errno()){
        die('Database failed to connect! '.mysqli_connect_error().'<br>');
    }else{
        echo "Database succussfuly connected! <br>";
    }

?>