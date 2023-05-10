<?php
session_start(); 
require 'connection.php';
$conn = Connect();

include 'assets.php'; ?>


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_reset($username,$user_email,$verify_token,$role){
  $mail = new PHPMailer(true);
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'inshafinzi60@gmail.com';                     //SMTP username
    $mail->Password   = 'cvhyuffxfysiwmtv';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('inshafinzi60@gmail.com', 'OC Rental');
    $mail->addAddress($user_email);                         //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OC Rental Password Reset Request';

    if($role == 'customer'){
        $email_template = " <h2>Password Reset Request</h2> <p> Hi $username, </p>
        <h4>Reset Your Password by clicking the below Link</h4>
        <br>
        <a href='http://127.0.0.1/OC_Rental/password_reset.php?token=$verify_token&role=customer&user=$username'>http://127.0.0.1/OC_Rental/password_reset.php?token=$verify_token&role=customer&user=$username</a>";
    }

    if($role == 'vendor'){
        $email_template = " <h2>Password Reset Request</h2> <p> Hi $username, </p>
        <h4>Reset Your Password by clicking the below Link</h4>
        <br>
        <a href='http://127.0.0.1/OC_Rental/password_reset.php?token=$verify_token&role=vendor&user=$username'>http://127.0.0.1/OC_Rental/password_reset.php?token=$verify_token&role=vendor&user=$username</a>";

    }


   

    $mail->Body    = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}
?>

<?php
$username_email = $_POST['uname_email'];
$user_role = $_POST['user'];


if($user_role == 'customer'){
    $sql = "SELECT * from customers WHERE customer_username='$username_email' OR customer_email='$username_email'";
    $sql_run = $conn->query($sql);

    if(mysqli_num_rows($sql_run) > 0){
        while($row = mysqli_fetch_assoc($sql_run)) {
            $username = $row['customer_username'];
            $customer_email = $row['customer_email'];
        }
        $verify_token = md5(rand());
        $role = 'customer';

        $token_update_query = "UPDATE customers SET verify_token = '$verify_token' WHERE customer_username='$username'";
        $token_update_run = $conn->query($token_update_query);

        if($token_update_run){
            sendemail_reset("$username","$customer_email","$verify_token","$role");
            echo "<script> 
            Swal.fire({
             icon: 'info',
             title: 'Password Reset Link Sent',
             text: 'Check Your Email for the password Reset Link',
           }).then(function() {
             window.location = 'index.php';
         });
     
       ;</script>";
            }
    
            if (!$token_update_run){
              die("Couldnt enter data: ".$conn->error);
            }
    }
    else{
        echo "<script> 
            Swal.fire({
             icon: 'error',
             title: 'No Users Found with the email or username',
             showConfirmButton: false,
             timer: 2000,
           }).then(function() {
             window.location = 'forgot_password.php?user=customer';
         });
     
       ;</script>";
    }
}
elseif($user_role == 'vendor'){
    $sql = "SELECT * from vendors WHERE vendor_username='$username_email' OR vendor_email='$username_email'";
    $sql_run = $conn->query($sql);

    if(mysqli_num_rows($sql_run) > 0){
        while($row = mysqli_fetch_assoc($sql_run)) {
            $username = $row['vendor_username'];
            $vendor_email = $row['vendor_email'];
        }
        $verify_token = md5(rand());
        $role = 'vendor';

        $token_update_query = "UPDATE vendors SET verify_token = '$verify_token' WHERE vendor_username='$username'";
        $token_update_run = $conn->query($token_update_query);

        if($token_update_run){
            sendemail_reset("$username","$vendor_email","$verify_token","$role");
                    echo "<script> 
                    Swal.fire({
                    icon: 'info',
                    title: 'Password Reset Link Sent',
                    text: 'Check Your Email for the password Reset Link',
                }).then(function() {
                    window.location = 'index.php';
                });
            
            ;</script>";
            }
    
            if (!$token_update_run){
              die("Couldnt enter data: ".$conn->error);
            }
    }
    else{
        echo "<script> 
            Swal.fire({
             icon: 'error',
             title: 'No Users Found with the email or username',
             showConfirmButton: false,
             timer: 2000,
           }).then(function() {
             window.location = 'forgot_password.php?user=vendor';
         });
     
       ;</script>";
    }
}
else{
    echo "<script> 
        Swal.fire({
         icon: 'error',
         title: 'Invalid Request',
         showConfirmButton: false,
         timer: 2000,
       }).then(function() {
         window.location = 'index.php';
     });
 
   ;</script>";
}

?>