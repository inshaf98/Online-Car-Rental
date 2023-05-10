<!DOCTYPE html>
<html>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // require 'connection.php';
    // $conn = Connect();

    require 'vendor/autoload.php';
    
    function sendemail_bill($customer_email,$brand_name,$car_name,$numberplate,$fare,$rent_start_date,$rent_end_date,$car_return_date,$distance_or_days,$extra_days,$total_fine,$total_amount){
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
        $mail->Subject = 'Invoice From OC Rental';

        if($total_fine == 0){
            $total_fine = 'N/A';
            $extra_days = 'N/A';
        }
    
    
        $email_template = '<h2><div style="padding-top:10px;" class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Car Returned</h1>
        </div>
    </div>

    <h2 class="text-center"> Thank you for Using OC Rentals! Hope you had a nice ride </h2>

    <h3 class="text-center"> <strong>Vehicle Name:</strong> <span style="color: blue;">'.$brand_name.' '.$car_name.'</span> </h3>

    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto;">
                <br><h3 style="color: orange;">Invoice</h3>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Number:</strong>'.$numberplate.'</h4>
                <h4> <strong>Fare:</strong> Rs.'.$fare.'/day</h4>
                <h4> <strong>Start Date: </strong>'.$rent_start_date.'</h4>
                <h4> <strong>Rent End Date: </strong>'.$rent_end_date.'</h4>
                <h4> <strong>Return Date: </strong>'.$car_return_date.'</h4>
                <h4> <strong>Number of days: </strong>'.$distance_or_days.' day(s)</h4>
                <h4> <strong>Extra Days:</strong>'.$extra_days.'</h4>
                <h4> <strong>Total Fine:</strong>'.$total_fine.'</h4>
                <h3> Total Amount: '.$total_amount.'</h3>
            </div>
        </div>';
    
        $mail->Body    = $email_template;
        $mail->send();
        // echo 'Message has been sent';
    }
    ?>

<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<?php include 'assets.php';?>
<?php include 'header.php';?>
<body>

<?php 
$id = $_GET["id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);

//getting feedback
$feedback = $conn->real_escape_string($_POST['feedback']);
$rating = $conn->real_escape_string($_POST['rating']);

$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $distance_or_days * $fare;
$car_return_date = date('Y-m-d');
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$cust = "SELECT customer_email FROM customers WHERE customer_username='$login_customer' LIMIT 1";
    $cust_run = mysqli_query($conn, $cust);
    if (mysqli_num_rows($cust_run) > 0) {
        while($cust_row = mysqli_fetch_assoc($cust_run)) {

                $customer_email = $cust_row["customer_email"];
           
        }
    }

$sql0 = "SELECT rc.id, rc.rent_end_date, rc.rent_start_date,c.brand_name, c.car_name, c.numberplate FROM rentedcars rc, cars c WHERE id = '$id' AND c.car_id = rc.car_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $brand_name = $row0["brand_name"];
            $car_name = $row0["car_name"];
            $numberplate = $row0["numberplate"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$extra_days = dateDiff("$rent_end_date", "$car_return_date");
$total_fine = $extra_days*(($fare / 100)*125);

$duration = dateDiff("$rent_start_date","$rent_end_date");

if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
}

    $no_of_days = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";


$result1 = $conn->query($sql1);

if ($result1){
     $sql2 = "UPDATE cars c, rentedcars rc SET c.car_availability='yes'
     WHERE rc.car_id=c.car_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
     $result2 = $conn->query($sql2);

     sendemail_bill("$customer_email","$brand_name","$car_name","$numberplate","$fare","$rent_start_date","$rent_end_date","$car_return_date","$distance_or_days","$extra_days","$total_fine","$total_amount");

}
else {
    echo $conn->error;
}

//entering data into feedback table
$sql3 = "INSERT INTO feedback(ordernumber, customername, brand_name, car_name, numberplate, message, rating) 
        VALUES ('".$id."','".$login_customer."','".$brand_name."','".$car_name."','".$numberplate."','".$feedback."','".$rating."')";


$success = $conn->query($sql3);
?>

    <div class="container" style="padding-top: 6rem">  
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Car Returned</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for Using OC Rentals! Hope you had a nice ride. </h2>



    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;"><br>
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Name: </strong> <?php echo $brand_name." ".$car_name;?></h4>
                <br>
                <h4> <strong>Vehicle Number:</strong> <?php echo $numberplate; ?></h4>
                <br>
                <h4> <strong>Fare:&nbsp;</strong>  Rs. <?php echo ($fare . "/day");?></h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Car Return Date: </strong> <?php echo $car_return_date; ?> </h4>
                <br>
                    <h4> <strong>Number of days:</strong> <?php echo $distance_or_days; ?>day(s)</h4>

                <br>
                <?php
                    if($extra_days > 0){       
                ?>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> Rs. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
                <br>
                <?php } ?>
                <h4> <strong>Total Amount: </strong> Rs. <?php echo $total_amount; ?>/-     </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
        </div>
    </div>

</body>
<?php include 'footer.php';?>
</html>