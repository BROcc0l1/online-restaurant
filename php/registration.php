<?php

session_start();

$errors = array();

// conect to database
$con = mysqli_connect('localhost', 'root', '', 'online_restaurant');
if (!$con) 
    die('Could not connect: ' . mysqli_error($con));

// register user
// TODO: fix field names
if (isset($_POST['submit_button'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($con, 
		$_POST['confirm_password']);


	if (empty($username)) array_push($errors, "Username is required");
	if (empty($email)) array_push($errors, "Email is required");
	if (empty($password)) array_push($errors, "Password is required");
	if (empty($password)) array_push($errors, "Please confirm your password");
	if ($password !== $confirm_password) array_push($errors, "Passwords don't match")

	$user_check_query = "SELECT * FROM `users` WHERE `username`='$username' LIMIT 1";

	$user_check_result = mysqli_query($con, $user_check_query);
	$check_user = mysqli_fetch_assoc($user_check_result);

	if ($user) {
      if ($check_user['username'] === $username) {
         array_push($errors, "Username already exists");
      }
    }

    // if no errors register user
    if (count($errors) == 0) {

    	// encript the password
    	$password = md5($password);

    	// write user to database
    	$reg_query = "INSERT INTO `users` (username, password, type) 
    	VALUES ('$username', '$password', 'user')";

    	mysqli_query($con, $reg_query);
    	$_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in!";
        $_SESSION['msg'] = "You have successfully registered, log in to continue.";

        // TODO: add redirect location
        // header('location: ');

    } else {

    	// TODO: print error messages

    }


}


?>