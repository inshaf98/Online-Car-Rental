<?php

require 'connection.php';
$conn = Connect(); 
include 'assets.php';


$role = $_POST['role'];
$user = $_POST['user'];

$pass = $_POST['password'];
$password = password_hash($pass, PASSWORD_DEFAULT);


if($role == 'customer'){
    $sql = "UPDATE customers SET customer_password = '$password' WHERE customer_username='$user'";
    $update_run = $conn->query($sql);

            if($update_run){
                echo "<script> 
                Swal.fire({
                icon: 'success',
                title: 'Password Succesfully Updated',
                text: 'You may now login to the system using your new password',
            }).then(function() {
                window.location = 'customerlogin.php';
            });

            ;</script>";

            $verify_token = md5(rand());
            $sql_token = "UPDATE customers SET verify_token = '$verify_token' WHERE customer_username='$user'";
            $update_token = $conn->query($sql_token);

        }

        if (!$update_run){
        die("Couldnt enter data: ".$conn->error);
        }


}
elseif($role == 'vendor'){
    $sql = "UPDATE vendors SET vendor_password = '$password' WHERE vendor_username='$user'";
    $update_run = $conn->query($sql);

            if($update_run){
                echo "<script> 
                Swal.fire({
                icon: 'success',
                title: 'Password Succesfully Updated',
                text: 'You may now login to the system using your new password',
            }).then(function() {
                window.location = 'vendorlogin.php';
            });

            ;</script>";

            $verify_token = md5(rand());
            $sql_token = "UPDATE vendors SET verify_token = '$verify_token' WHERE vendor_username='$user'";
            $update_token = $conn->query($sql_token);

        }

        if (!$update_run){
        die("Couldnt enter data: ".$conn->error);
        }


}
else{
    echo "<script> 
    Swal.fire({
    icon: 'error',
    title: 'Invalid Request',
    showConfirmButton: false,
    timer: 2500,
}).then(function() {
    window.location = 'index.php';
});

;</script>";
}

?>