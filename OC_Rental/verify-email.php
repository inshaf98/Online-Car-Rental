<?php
session_start();
include 'assets.php';
require 'connection.php';
$conn = Connect();

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status from customers WHERE verify_token='$token' LIMIT 1";
    $verify_run = $conn->query($verify_query);

    if(mysqli_num_rows($verify_run) > 0){
        $row = mysqli_fetch_array($verify_run);

        if($row['verify_status']=="0"){
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE customers SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_run = $conn->query($update_query);

            if($update_run){
                $_SESSION['status'] = "Your Account has been verfied Successfully!";
                header("Location:customerlogin.php");
                exit(0);
            }
            else{
                $_SESSION['status'] = "Verification Failed!";
                header("Location:customerlogin.php");
                exit(0);
            }

        }
        else{
            $_SESSION['status'] = "Email Already Verified. Please Login";
             header("Location:customerlogin.php");
        }
        
        
    }
    else{
        $_SESSION['status'] = "Invalid Token";
        header("Location:customerlogin.php");
    }

}
else{
    $_SESSION['status'] = "Not Allowed";
    header("Location:customerlogin.php");
}

?>