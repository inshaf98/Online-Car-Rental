<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['admin_username']) || empty($_POST['admin_password'])) {
		$error = "All Fields are Required";
	}
	else{
		// Define $username and $password
		$admin_username=$_POST['admin_username'];
		$admin_password=$_POST['admin_password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		require 'connection.php';
		$conn = Connect();

		// SQL query to fetch information of registerd users and finds user match.
		$login_query = "SELECT * FROM admin WHERE username='$admin_username' AND password='$admin_password' LIMIT 1";
		$login_run = mysqli_query($conn, $login_query);

		if(mysqli_num_rows($login_run) > 0){

			$row = mysqli_fetch_array($login_run);

				$_SESSION['login_admin']=$admin_username;
				header("location: admin_dashboard.php");
		}
		else{
			$error = "Username or Password is invalid";
		}

		mysqli_close($conn); // Closing Connection
		}
}
?>