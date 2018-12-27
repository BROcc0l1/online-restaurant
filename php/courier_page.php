<?php

session_start();

// setcookie('updating', 1, time() + (86400 * 30), "/");

// connect to database
$con = mysqli_connect('localhost','root','','online_restaurant');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// get order
$update_query = "SELECT id, address FROM orders WHERE status='Cooked' LIMIT 1";

$update_query_result = mysqli_query($con, $update_query);

$data = mysqli_fetch_assoc($update_query_result);	

$order_id = $data['id'];

$order_address = $data['address'];

$_SESSION['order_id'] = $order_id;

echo $order_id;
echo '<br><br>';
echo $order_address;

mysqli_close($con);

?>

<!DOCTYPE html>

<html>


<head>

    <meta charset="UTF-8">

</head>


<body>

    <form action="courier_take_order.php">
    
        <button> Take order </button>

    </form>

</body>