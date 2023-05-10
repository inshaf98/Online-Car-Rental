<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require 'connection.php';
$conn = Connect();

if( empty(session_id()) && !headers_sent()){
    session_start();
}

// session_start();// Starting Session

// Storing Session
if(isset($_SESSION['login_admin'])){
    $user_check=$_SESSION['login_admin'];
}
else{
    $user_check="";
}
// $user_check=$_SESSION['login_admin'];

// SQL Query To Fetch Complete Information Of User
$query = "SELECT username FROM admin WHERE username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
// $login_session =$row['admin_username'];
?>