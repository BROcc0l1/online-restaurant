<?php

session_start();

// conect to database
$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
if (!$con) die('Could not connect: ' . mysqli_error($con));

if (isset($_GET['take_order_button'])) {

$order_id = $_SESSION['order_id'];

$_SESSION['order_id'] = $order_id;

// update order status
$update_order_data_query = "UPDATE `orders` SET status='Being delivered' WHERE id='$order_id'";
mysqli_query($con, $update_order_data_query);

// output order address
$order_address_query = "SELECT address FROM `orders` WHERE id='$order_id' LIMIT 1";
$order_address = mysqli_fetch_assoc(mysqli_query($con, $order_address_query));

echo $order_id;
echo "<br><br>";
echo $order_address['address'];

mysqli_close($con);

}

?>

<!DOCTYPE html>

<head>
</head>

<body>

	<form action="courier_end_order.php">
		<button name="end_order_button"> Finish order </button>
	</form>

</body>

<html>