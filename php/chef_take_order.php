<?php

session_start();

if ($_SESSION['type'] != "chef" and $_SESSION['type'] != "admin") {
	header('Location: ../index.html');
}

// conect to database
$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
if (!$con) die('Could not connect: ' . mysqli_error($con));

#if (isset($_POST['take_order_button'])) {

$order_id = $_SESSION['order_id'];

$_SESSION['order_id'] = $order_id;

// update order status
$update_order_data_query = "UPDATE `orders` SET status='Being cooked' WHERE id='$order_id'";
mysqli_query($con, $update_order_data_query);

// output order
$foods_query = "SELECT foods_ids FROM `orders` WHERE id='$order_id' LIMIT 1";

$foods_query_result = mysqli_query($con, $foods_query);

$foods_data = mysqli_fetch_assoc($foods_query_result);

$food_ids = explode(" ", $foods_data['foods_ids']);

// get food names by IDs
$food_names = array();

foreach ($food_ids as $id) {

	$get_food_names_query = "SELECT name FROM `menu` where id='$id'";

	$food_name_query_result = mysqli_query($con, $get_food_names_query);

	$name = mysqli_fetch_assoc($food_name_query_result);

	array_push($food_names, $name['name']);

}


// remove products from warehouse
foreach ($food_ids as $fid) {
	$get_food_products_query = "SELECT product_id, product_quantity FROM `menu_ingredients` WHERE menu_item_id='$fid'";
	$get_food_products_query_result = mysqli_query($con, $get_food_products_query);
	
	while ($row = mysqli_fetch_row($get_food_products_query_result)) {

		$id = $row[0];
		$quan = $row[1];

		$get_quantity_query = "SELECT quantity FROM `warehouse` WHERE id='$id' LIMIT 1";
		$quantity_query_result = mysqli_fetch_assoc(mysqli_query($con, $get_quantity_query));
		$quantity = $quantity_query_result['quantity'];
		# echo $quantity; echo " "; echo $quan; echo " ";
		$quantity -= $quan;
		# echo $quantity; echo "<br><br>";

		$update_quantity_query = "UPDATE `warehouse` SET quantity='$quantity' WHERE id='$id'";
		mysqli_query($con, $update_quantity_query);

	}

}


echo $order_id;
echo '<br><br>';
foreach ($food_names as $fn) {
	echo $fn;
	echo '<br>';
}

#}

mysqli_close($con);

?>

<!DOCTYPE html>

<head>
</head>

<body>

	<form action="chef_end_order.php">
		<button> Finish order </button>
	</form>

</body>

<html>