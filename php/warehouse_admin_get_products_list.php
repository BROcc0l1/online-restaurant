<?php

	session_start();

	if ($_SESSION['type'] != "warehouse-admin" and $_SESSION['type'] != "admin") {
		header('Location: ../index.html');
	}

	$product_to_add_quantity = 0;

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
	}

?>