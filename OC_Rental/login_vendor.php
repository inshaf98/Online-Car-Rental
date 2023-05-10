<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['vendor_username']) || empty($_POST['vendor_password'])) {
	$error = "All Fields are Required";
	}
	else
	{
	// Define $username and $password
	$vendor_username=$_POST['vendor_username'];
	$vendor_password=$_POST['vendor_password'];
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	require 'connection.php';
	$conn = Connect();

	// SQL query to fetch information of registerd users and finds user match.
	$login_query = "SELECT * FROM vendors WHERE vendor_username='$vendor_username' LIMIT 1";
	$login_run = mysqli_query($conn, $login_query);

	if(mysqli_num_rows($login_run) > 0){

		$row = mysqli_fetch_array($login_run);

		if($vendor_password == $row['vendor_password'] || password_verify($vendor_password, $row['vendor_password'])){
			if($row['verify_status'] == "1"){
				$_SESSION['login_vendor']=$vendor_username;
				header("location: index.php");
			}
			else{
				$error = "Please Verify Your Email Address to Login";
			}
		}
		else{
			$error = "Username or Password is invalid";
		}

		

	}
	else{
		$error = "Username or Password is invalid";
	}

	// To protect MySQL injection for Security purpose
	// $stmt = $conn->prepare($query);
	// $stmt -> bind_param("ss", $vendor_username, $vendor_password);
	// $stmt -> execute();
	// $stmt -> bind_result($vendor_username, $vendor_password);
	// $stmt -> store_result();

	// if ($stmt->fetch())  //fetching the contents of the row
	// {
	// 	$_SESSION['login_vendor']=$vendor_username; // Initializing Session
	// 	header("location: index.php"); // Redirecting To Other Page
	// } else {
	// $error = "Username or Password is invalid";
	// }
	mysqli_close($conn); // Closing Connection
	}
}
?>