<?php

session_start();

$order_id = $_SESSION['order_id'];

// conect to database
$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
if (!$con) die('Could not connect: ' . mysqli_error($con));

// update order status
$update_order_data_query = "UPDATE `orders` SET status='Delivered' WHERE id='$order_id'";
mysqli_query($con, $update_order_data_query);

unset($_SESSION['order_id']);

mysqli_close($con);

// redirect to main courier page
ob_start();
header('Location: '."courier_page.php");
ob_end_flush();
die();


?>