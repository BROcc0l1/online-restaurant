<?php

	session_start();

	if ($_SESSION['type'] != "warehouse-admin" and $_SESSION['type'] != "admin") {
		header('Location: ../index.html');
	}

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
        xmlhttp.open("GET","warehouse_admin_page.php",true);
        xmlhttp.send();
    }
}
</script>

</head>

<body>

<form action="warehouse_admin_get_products_list.php">
	<button> Get products list </button>
</form>

<form action="warehouse_admin_add_products.php">
	<button> Add products </button>
</form>

</body>
</html>