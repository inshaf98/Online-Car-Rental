<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require 'connection.php';
$conn = Connect();

if( empty(session_id()) && !headers_sent()){
    session_start();
}

// session_start();// Starting Session

// Storing Session
// $user_check=$_SESSION['login_customer'];

if(isset($_SESSION['login_customer'])){
    $user_check=$_SESSION['login_customer'];
}
else{
    $user_check="";
}

// SQL Query To Fetch Complete Information Of User
$query = "SELECT customer_username FROM customers WHERE customer_username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['customer_username'];
?>