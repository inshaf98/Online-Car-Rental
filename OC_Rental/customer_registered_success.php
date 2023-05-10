<html>
<?php
session_start();
include 'assets.php';
// include 'header.php';
?>

<!--Back to top button..................................................................................-->
<!-- <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button> -->
<!--Javacript for back to top button....................................................................-->
<script type="text/javascript">
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>


<?php

require 'connection.php';
$conn = Connect();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($customer_name,$customer_email,$verify_token){
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
    $mail->addAddress($customer_email);                         //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from OC Rental';


    $email_template = " <h2>You Have Registered with OC Rental</h2>
    <h4>Verify Your Email Address by clicking the below Link</h4>
    <br>
    <a href='http://127.0.0.1/OC_Rental/verify-email.php?token=$verify_token'>http://127.0.0.1/OC_Rental/verify-email.php?token=$verify_token</a>";

    $mail->Body    = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

function GetImageExtension($imagetype) {
  if(empty($imagetype)) return false;
  
  switch($imagetype) {
      case 'assets/img/profiles/customer/bmp': return '.bmp';
      case 'assets/img/profiles/customer/gif': return '.gif';
      case 'assets/img/profiles/customer/jpeg': return '.jpg';
      case 'assets/img/profiles/customer/png': return '.png';
      default: return false;
  }
}

$customer_name = $conn->real_escape_string($_POST['customer_name']);
$customer_username = $conn->real_escape_string($_POST['customer_username']);
$customer_nic = $conn->real_escape_string($_POST['customer_nic']);
$customer_email = $conn->real_escape_string($_POST['customer_email']);
$customer_phone = $conn->real_escape_string($_POST['customer_phone']);
$customer_address = $conn->real_escape_string($_POST['customer_address']);
$customer_password_to_encrypt = $conn->real_escape_string($_POST['customer_password']);
$verify_token = md5(rand());

$customer_password = password_hash($customer_password_to_encrypt, PASSWORD_DEFAULT);


//check Exist
$check_email_query = "SELECT * FROM customers WHERE customer_email = '$customer_email' LIMIT 1";
$check_email_run = $conn->query($check_email_query);

$check_nic_query = "SELECT * FROM customers WHERE customer_nic = '$customer_nic' LIMIT 1";
$check_nic_run = $conn->query($check_nic_query);

$check_username_query = "SELECT * FROM customers WHERE customer_username = '$customer_username' LIMIT 1";
$check_username_run = $conn->query($check_username_query);
if(mysqli_num_rows($check_username_run) > 0){
  $_SESSION['status'] = "Username Already Taken";
  header("Location: customersignup.php");
}
elseif(mysqli_num_rows($check_nic_run) > 0){
  $_SESSION['status'] = "NIC Already Registered";
  header("Location: customersignup.php");
}
elseif(mysqli_num_rows($check_email_run) > 0){
  $_SESSION['status'] = "Email ID Already Exist";
  header("Location: customersignup.php");
}
elseif (!empty($_FILES["profileimage"]["name"])) {
    $file_name=$_FILES["profileimage"]["name"];
    $temp_name=$_FILES["profileimage"]["tmp_name"];
    $imgtype=$_FILES["profileimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename=$_FILES["profileimage"]["name"];
    $target_path = "assets/img/profiles/customer/".$imagename;



    if(move_uploaded_file($temp_name, $target_path)) {
  
        $query = "INSERT into customers(customer_username,customer_name,customer_nic,customer_phone,customer_email,customer_address,profile_image,customer_password,verify_token) VALUES('" . $customer_username . "','" . $customer_name . "','" . $customer_nic . "','" . $customer_phone . "','" . $customer_email . "','" . $customer_address ."','".$target_path."','" . $customer_password ."','" . $verify_token ."')";
        $success = $conn->query($query);
        
        if($success){
        sendemail_verify("$customer_name","$customer_email","$verify_token");
        }

        if (!$success){
          die("Couldnt enter data: ".$conn->error);
        }
        
    } 
}
else{
  echo "<h3 style='color:red'>No Profile Images Uploaded Failed To Create Account</h3>";
}


?>

<div class="container" style="margin-top:60px; ">
    <div class="jumbotron" style="text-align: center;">
        <h2> <?php echo "Welcome $customer_name!" ?> </h2>
        <h1>Your account has been created.</h1>
        <p>Please check your email to Verify your account</p>
        <a style="color:blue;" href="index.php">Go To HomePage</a>
    </div>
</div>

</body>

</html>