<?php

session_start();

if ($_SESSION['type'] != "chef" and $_SESSION['type'] != "admin") {
	header('Location: ../index.html');
}

// connect to database
$con = mysqli_connect('localhost','root','','online_restaurant');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

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

mysqli_close($con);

?>

<!DOCTYPE html>

<html>


<head>

    <meta charset="UTF-8">

</head>


<body>

    <form action="chef_take_order.php">
    
        <button> Take order </button>

    </form>

</body>