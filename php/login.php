<?php

	session_start();

	$errors = array();


	// connect to database
	$con = mysqli_connect('localhost', 'root', '', 'proga_registretion');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));


	// login
	// TODO: fix field names
	if (isset($_POST['submit_login'])) {

		$username = mysqli_real_escape_string($con, $_POST['login_username']);
		$password = mysqli_real_escape_string($con, $_POST['login_password']);

		if (empty($username)) array_push($errors, "Username is required");
    	if (empty($password)) array_push($errors, "Password is required");

    	if (count($errors) == 0) {

    		$password = md5($password);

    		$login_query = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";

    		$login_query_result = mysqli_query($con, $login_query);

    		if(mysqli_num_rows($login_query_result) == 1) {

    			$userdata = mysqli_fetch_assoc($login_query_result);

   				$_SESSION['username'] = $username; 
   				$_SESSION['usertype'] = $userdata['type'];
   				$_SESSION['success'] = "You are now logged in!";
   				

   				// TODO: add headers for different user types
   				// header('location: index.html');
   				if ($_SESSION['type'] == "user") header('location: index.html');
   				if ($_SESSION['type'] == "admin") header('location: index.html');
   				if ($_SESSION['type'] == "chef") header('location: php/chef_page.php');
   				if ($_SESSION['type'] == "courier") header('location: php/courier_page.php');
   				if ($_SESSION['type'] == "warehouse-admin") header('location: php/warehouse_admin_page.php');

  			} else {

  				// TODO: output error messages
  				array_push($errors, "Wrong username or password");

  			}

    	}


	}



?>