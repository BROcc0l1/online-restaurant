<?php

$mode = 'wait_order';
$mode = strval($_GET['mode']);


// connect to database
$con = mysqli_connect('localhost','root','','online_restaurant');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


// get order
$update_query = "SELECT id, foods_ids FROM orders WHERE status IN ('Being cooked', 'Order registered') LIMIT 1";

$update_query_result = mysqli_query($con, $update_query);

$data = mysqli_fetch_assoc($update_query_result);	

$order_id = $data['id'];

$food_ids = explode(" ", $data['foods_ids']);

$food_names = array();

// get food names by IDs

foreach ($food_ids as $id) {

	$get_food_names_query = "SELECT name FROM `menu` where id='$id'";

	$food_name_query_result = mysqli_query($con, $get_food_names_query);

	$name = mysqli_fetch_assoc($food_name_query_result);

	array_push($food_names, $name['name']);

}

if ($mode = 'wait_order') {

// output order list
echo 'Order number '; 
echo $order_id;
echo '<br><br> Foods:<br>';

foreach ($food_names as $fn) {
	echo $fn;
	echo '<br>';
}

}

if ($mode = 'cook') {

	if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
 	}

 	$update_order_data_query = "UPDATE `orders` SET status='Being cooked' WHERE id='$order_id'";
 	mysqli_query($con, $update_order_data_query);

}


?>