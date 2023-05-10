<!DOCTYPE html>
<html>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // require 'connection.php';
    // $conn = Connect();

    require 'vendor/autoload.php';
    
    function sendemail_invoice($customer_username,$customer_email,$id,$car_name,$car_nameplate,$fare,$rent_start_date,$rent_end_date,$vendor_name,$vendor_phone){
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
        $mail->Subject = 'Booking Confirmation From OC Rental';
    
    
        $email_template = '<h2><div style="padding-top:10px;" class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Booking Confirmed.</h1>
        </div>
    </div>

    <h2 class="text-center"> Thank you for using Car Rental System! We wish you have a safe ride. </h2>

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;">'.$id.'</span> </h3>

    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto;">
                <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3>
                <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h4>
                <br><h3 style="color: orange;">Order Details</h3>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Name: </strong>'.$car_name.'</h4>
                <h4> <strong>Vehicle Number:</strong>'.$car_nameplate.'</h4>
                <h4> <strong>Fare:</strong> Rs.'.$fare.'/day</h4>
                <h4> <strong>Booking Date: </strong>'.date("Y-m-d").'</h4>
                <h4> <strong>Start Date: </strong>'.$rent_start_date.'</h4>
                <h4> <strong>Return Date: </strong>'.$rent_end_date.'</h4>
                <h4> <strong>Vendor Name:</strong>'.$vendor_name.'</h4>
                <h4> <strong>Vendor Contact: </strong>'.$vendor_phone.'</h4>
            </div>
        </div>';
    
        $mail->Body    = $email_template;
        $mail->send();
        // echo 'Message has been sent';
    }
    ?>

<?php 


 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
    <title>Confirm Booking</title>
</head>

<?php include 'assets.php';?>
<?php include 'header.php';?>

<?php
    $customer_username = $_SESSION["login_customer"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";
    $transaction_id = $conn->real_escape_string($_POST['tr_id']);
    $pay_amount = $conn->real_escape_string($_POST['amount']);

    $cust = "SELECT customer_email FROM customers WHERE customer_username='$customer_username' LIMIT 1";
    $cust_run = mysqli_query($conn, $cust);
    if (mysqli_num_rows($cust_run) > 0) {
        while($cust_row = mysqli_fetch_assoc($cust_run)) {

                $customer_email = $cust_row["customer_email"];
           
        }
    }



    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

                $fare = $row0["price_per_day"];
           
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username,car_id,booking_date,rent_start_date,rent_end_date,fare,return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','". $return_status . "')";
    $result1 = $conn->query($sql1);

    $sqlpay = "INSERT into payment(transaction_id,customer_username,car_id,order_id,email,amount,payment_date)
    VALUES('".$transaction_id."','" . $customer_username . "','" . $car_id . "',LAST_INSERT_ID(),'".$customer_email."','".$pay_amount."','" . date("Y-m-d") ."')";
    $result1 = $conn->query($sqlpay);

    $sql2 = "UPDATE cars SET car_availability = 'no' WHERE car_id = '$car_id'";
    $result2 = $conn->query($sql2);

    $sql4 = "SELECT * FROM  cars c, vendors cl, rentedcars rc WHERE c.car_id = '$car_id'";
    $result4 = $conn->query($sql4);

    $sql5 = "SELECT vc.vendor_username, v.vendor_phone FROM vendors v, vendorcars vc WHERE vc.car_id= '$car_id' AND vc.vendor_username=v.vendor_username";
    $result5 = $conn->query($sql5);

    if (mysqli_num_rows($result5) > 0) {
        while($row = mysqli_fetch_assoc($result5)) {
            $vendor_name = $row["vendor_username"];
            $vendor_phone = $row["vendor_phone"];
        }
    }

    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $car_name = $row["car_name"];
            $car_nameplate = $row["numberplate"];
        }
    }

    if (!$result1 | !$result2){
        die("Couldnt enter data: ".$conn->error);
    }

    sendemail_invoice("$customer_username","$customer_email","$id","$car_name","$car_nameplate","$fare","$rent_start_date","$rent_end_date","$vendor_name","$vendor_phone");

?>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron">
        <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Booking
            Confirmed.</h1>
    </div>
</div>
<br>

<h2 class="text-center"> Thank you for using Car Rental System! We wish you have a safe ride. </h2>



<h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span>
</h3>


<div class="container">
    <h5 class="text-center">Please read the following information about your order.</h5>
    <div class="box">
        <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
            <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3>
            <br>
            <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to
                communicate with us about your order.</h4>
            <br>
            <h3 style="color: orange;">Invoice</h3>
            <br>
        </div>
        <div class="col-md-10" style="float: none; margin: 0 auto; ">
            <h4> <strong>Vehicle Name: </strong> <?php echo $car_name; ?></h4>
            <br>
            <h4> <strong>Vehicle Number:</strong> <?php echo $car_nameplate; ?></h4>
            <br>

            <h4> <strong>Fare:</strong> Rs. <?php echo $fare; ?>/day</h4>


            <br>
            <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
            <br>
            <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
            <br>
            <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
            <br>
            <h4> <strong>Vendor Name:</strong> <?php echo $vendor_name; ?></h4>
            <br>
            <h4> <strong>Vendor Contact: </strong> <?php echo $vendor_phone; ?></h4>
            <br>
        </div>
    </div>
    <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
        <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy
            of this page, please print it now.</h6>
    </div>
</div>




</body>
<?php } else { ?>

<div class="container">
    <div class="jumbotron" style="text-align: center;">
        You have selected an incorrect date.
        <br><br>
    </div>
    <?php } ?>
    <?php include 'footer.php';?>

</html>