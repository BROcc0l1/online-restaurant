<?php

session_start();

// setcookie('updating', 1, time() + (86400 * 30), "/");

// connect to database
$con = mysqli_connect('localhost','root','','online_restaurant');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}



/*if (isset($_POST['take_order'])) {

	$update_query = "SELECT id, foods_ids FROM orders WHERE status='Order registered' OR status='Being cooked' LIMIT 1";

	$update_query_result = mysqli_query($con, $update_query);

	$data = mysqli_fetch_assoc($update_query_result);	

	$order_id = $data['id'];

	setcookie('updating', 0, time() + (86400 * 30), "/");

	if ($_COOKIE['updating'] == 1) {

			setcookie('updating', 0, time() + (86400 * 30), "/");

			echo 1;

			$update_order_data_query = "UPDATE `orders` SET status='Being cooked' WHERE id='$order_id'";
 			mysqli_query($con, $update_order_data_query);
 		} else {

 			setcookie('updating', 1, time() + (86400 * 30), "/");

 			echo 2;

			$update_order_data_query = "UPDATE `orders` SET status='Being cooked' WHERE id='$order_id'";
 		}

 		header('location: ../test.php');

	}

if($_COOKIE['updating'] == 1) {

$food_names = array();*/

// get order
$update_query = "SELECT id, foods_ids FROM orders WHERE status='Order registered' LIMIT 1";

$update_query_result = mysqli_query($con, $update_query);

$data = mysqli_fetch_assoc($update_query_result);	

$order_id = $data['id'];

$_SESSION['order_id'] = $order_id;

$food_ids = explode(" ", $data['foods_ids']);

// get food names by IDs

$food_names = array();

foreach ($food_ids as $id) {

	$get_food_names_query = "SELECT name FROM `menu` where id='$id'";

	$food_name_query_result = mysqli_query($con, $get_food_names_query);

	$name = mysqli_fetch_assoc($food_name_query_result);

	array_push($food_names, $name['name']);

}


echo $order_id;
echo '<br><br>';
foreach ($food_names as $fn) {
	echo $fn;
	echo '<br>';
}


?>
