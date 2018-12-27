<?php

	
	session_start();

	// $errors = array();

	/*$product_to_add_quantity = 0;

	// conect to database
	$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
	if (!$con) die('Could not connect: ' . mysqli_error($con));


	// get warehouse stats
	$get_warehouse_stats_query = "SELECT name, quantity FROM `warehouse` ORDER BY name";
	$warehouse_stats_query_result = mysqli_query($con, $get_warehouse_stats_query);
	$warehouse_stats = mysqli_fetch_assoc($warehouse_stats_query_result);

	// print to screen
	echo "<table border=4><tr><th>Продукт</th><th>Вес на складе</th></tr>";

	while ($row = mysqli_fetch_row($warehouse_stats_query_result)) {
    	echo "<tr>";
        	for ($j = 0 ; $j < 2 ; ++$j) echo "<td>$row[$j]</td>";
    	echo "</tr>";
	}*/
/*
	// add products to warehouse
	if (isset($_POST['add_to_warehouse'])) {

		$product_to_add = mysqli_real_escape_string($con, $_POST['product_to_add_input']);
		$product_to_add_quantity = mysqli_real_escape_string($con, $_POST['quantity_input']);

		// check for empty inputs
		if (empty($product_to_add)) array_push($errors, "Input all the fields!");
		if (empty($product_to_add_quantity)) array_push($errors, "Input all the fields!");

		// update database
		if (count($errors) == 0) {

			$get_quantity_query = "SELECT quantity FROM `warehouse` WHERE name='$product_to_add' LIMIT 1";
			$quantity_query_result = mysqli_fetch_assoc(mysqli_query($con, $get_quantity_query));
			$quantity = $quantity_query_result['quantity'];
			echo $quantity; echo " ";
			echo $product_to_add_quantity;
			$quantity += $product_to_add_quantity;

			$update_quantity_query = "UPDATE `warehouse` SET quantity='$quantity' WHERE name='$product_to_add'";

			mysqli_query($con, $update_quantity_query);

		} else {
			// TODO: output error messages
		}
	}

*/
?>

<!DOCTYPE html>
<html>
<head>

<script>
function addToWarehouse(name, quantity) {
    if (name == "") {
        //document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        /*xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };*/
        xmlhttp.open("GET","warehouse_admin_page.php?name="+name+"&q="+quantity,true);
        xmlhttp.send();
    }
}
</script>

</head>

<body>
 	<!--
	<form action="warehouse_admin_add_foods.php">

		<button name="add_to_warehouse">Add foods to warehouse</button>

	</form>

	<form action='addToWarehouse(product_to_add_input.value, quantity_input.value);'>

		<input type="text" name="product_to_add_input">
		<input type="number" name="quantity_input">
		<button name="add_to_warehouse"> Add products </button>

	</form>
	
	<input type="text" name="product_to_add_input" id="1">
	<input type="number" name="quantity_input" id="2">
	<button name="add_to_warehouse" onclick='addToWarehouse(document.getElementById("1").value, document.getElementById("2").value);''> Add products </button>
-->

<form action="warehouse_admin_get_products_list.php">
	<button> Get products list </button>
</form>

<form action="warehouse_admin_add_products.php">
	<button> Add products </button>
</form>

</body>
</html>