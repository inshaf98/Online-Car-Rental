<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require 'connection.php';
$conn = Connect();

if( empty(session_id()) && !headers_sent()){
    session_start();
}

// Storing Session
if(isset($_SESSION['login_vendor'])){
    $user_check=$_SESSION['login_vendor'];
    $query = "SELECT vendor_username FROM vendors WHERE vendor_username = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session =$row['vendor_username'];
}
else{
    $user_check="";
}



?>