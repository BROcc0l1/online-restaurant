<?php
	
	session_start();

	if ($_SESSION['type'] != "warehouse-admin" and $_SESSION['type'] != "admin") {
		header('Location: ../index.html');
	}

	$errors = array();

	$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
	if(!$con) die ('Could not connect: ' . mysqli_error($con));

	if (isset($_POST['add_to_warehouse'])) {


		$product_to_add = mysqli_real_escape_string($con, $_POST['product_to_add_input']);
		$quantity_to_add = mysqli_real_escape_string($con, $_POST['quantity_input']);

		// form validation
		if(empty($product_to_add)) array_push($errors, "Fill all fields");
		if(empty($quantity_to_add)) array_push($errors, "Fill all fields");

		$get_quantity_query = "SELECT quantity FROM `warehouse` WHERE name='$product_to_add' LIMIT 1";
		$quantity_query_result = mysqli_fetch_assoc(mysqli_query($con, $get_quantity_query));
		$quantity = $quantity_query_result['quantity'];
		$quantity += $quantity_to_add;

		$update_quantity_query = "UPDATE `warehouse` SET quantity='$quantity' WHERE name='$product_to_add'";

		mysqli_query($con, $update_quantity_query);

		header('location: warehouse_admin_page.php');

	}

		 
?>

<!DOCTYPE html>

<html>

<head>
	
</head>

<body>
	
	<form method="POST" action="#">

		<input type="text" name="product_to_add_input">
		<input type="number" name="quantity_input">
		<button name="add_to_warehouse"> Add products </button>

	</form>

</body>
</html>