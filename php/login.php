<?php

	session_start();

	$errors = array();


	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'proga_registretion');


	// login
	// TODO: fix field names
	if (isset($_POST['login'])) {

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) array_push($errors, "Username is required");
    	if (empty($password)) array_push($errors, "Password is required");

    	if (count($errors) == 0) {

    		$password = md5($password);

    		$login_query = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";

    		$login_query_result = mysqli_query($db, $login_query);

    		if(mysqli_num_rows($login_query_result) == 1) {

    			$userdata = mysqli_fetch_assoc($login_query_result);

   				$_SESSION['username'] = $username; 
   				$_SESSION['usertype'] = $userdata['type'];
   				$_SESSION['success'] = "You are now logged in!";
   				

   				// TODO: add headers for different user types
   				// header('location: index.html');

  			} else {

  				// TODO: output error messages
  				array_push($errors, "Wrong username or password");

  			}

    	}


	}



?>