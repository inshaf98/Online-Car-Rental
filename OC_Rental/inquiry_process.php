<?php
session_start(); 
require 'connection.php';
$conn = Connect();
include 'assets.php';

if(isset($_SESSION['login_admin'])){
  $id = $_GET["id"];
  $reply = $_POST['reply'];
  $status = 1;

  // $reply = $conn->real_escape_string($_POST['reply']);
  $query = "UPDATE inquiry SET reply ='".$reply."',status=".$status." WHERE inquiry_id=".$id;
  $result = $conn->query($query);

  if ($result){
    echo "<script> 
    Swal.fire({
     icon: 'success',
     title: 'Inquiry Updated',
     text: 'Customer Will be able to see the reply',
     showConfirmButton: false,
     timer:2500,
   }).then(function() {
     window.location = 'my_inquiry.php';
 });

;</script>";
}
else {
    echo $conn->error;
}

}

if(isset($_SESSION['login_customer'])){
  $query = $conn->real_escape_string($_POST['query']);
  $uname = $conn->real_escape_string($_POST['uname']);
  // echo $uname;
  // echo $query;
  $status = 0;
  
      $queryy = "INSERT into inquiry(customer_username,date,query,status) 
      VALUES('".$uname."','".date("Y-m-d") ."','".$query."','".$status."')";
      $result = $conn->query($queryy);
  
      if ($result){
         echo "<script> 
         Swal.fire({
          icon: 'success',
          title: 'Inquiry Sent',
          text: 'You will Receive Reply Soon. Check My Inquiry Section',
          showConfirmButton: true,
        }).then(function() {
          window.location = 'inquiry.php';
      });
  
    ;</script>";
     }
     else {
         echo $conn->error;
     }

 }
 else{
 
 }



?>