<?php
// session_start(); // Starting Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['customer_username']) || empty($_POST['customer_password'])) {
		$error = "All Fields are Required";
	}
	else{
		// Define $username and $password
		$customer_username=$_POST['customer_username'];
		$customer_password=$_POST['customer_password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		require 'connection.php';
		$conn = Connect();

		// SQL query to fetch information of registerd users and finds user match.
		$login_query = "SELECT * FROM customers WHERE customer_username='$customer_username' LIMIT 1";
		$login_run = mysqli_query($conn, $login_query);

		if(mysqli_num_rows($login_run) > 0){

			$row = mysqli_fetch_array($login_run);

			if($customer_password == $row['customer_password'] || password_verify($customer_password, $row['customer_password'])){
				if($row['verify_status'] == "1"){
					$_SESSION['login_customer']=$customer_username;
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
		// $stmt -> bind_param("ss", $customer_username, $customer_password);
		// $stmt -> execute();
		// $stmt -> bind_result($customer_username, $customer_password);
		// $stmt -> store_result();

		// if ($stmt->fetch())  //fetching the contents of the row
		// {
		// 	$_SESSION['login_customer']=$customer_username; // Initializing Session
		// 	header("location: index.php"); // Redirecting To Other Page
		// } else {
		// 	$error = "Username or Password is invalid";
		// }
		mysqli_close($conn); // Closing Connection
		}
}
?>