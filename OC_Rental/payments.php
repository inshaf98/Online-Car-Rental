<!DOCTYPE html>
<html>
<?php 
session_start();
?>

<head>
    <title>Payments</title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>


<?php 
    require 'connection.php';
    $conn = Connect();

if(isset($_SESSION['login_admin'])){
    $sql1 = "SELECT * FROM payment ORDER BY order_id DESC";
}
else{
    session_destroy();
    header("location: index.php");
}

$result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
       
?>
<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1 class="text-center">Payments - OC Rental</h1>
        <p class="text-center"> All the payments made for bookings are shown here </p>
    </div>
</div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 190px;">


    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th width="15%">Order ID</th>
                <th width="20%">Payment Date</th>
                <th width="15%">Customer</th>
                <th width="25%">Car</th>
                <th width="30%">Transaction ID</th>
                <th width="15%">Amount</th>

            </tr>
        </thead>
        <?php
while($row = mysqli_fetch_assoc($result1)) {
            $car_id = $row["car_id"];
            $sql2 = "SELECT brand_name, car_name from cars WHERE car_id = $car_id";
            $resultt = $conn->query($sql2);
                while($row2=$resultt->fetch_assoc()){
                    $car = $row2["brand_name"].' '.$row2["car_name"];
                }
?>
        <tr>
            <td style="padding-top:20px;"><?php echo $row["order_id"]; ?></td>
            <td style="padding-top:20px;"><?php echo $row["payment_date"] ?></td>
            <td style="padding-top:20px;"><?php echo $row["customer_username"]; ?></td>
            </td>
            <td style="padding-top:20px;"><?php echo $car ?></td>
            <td style="padding-top:20px;"><?php echo $row["transaction_id"]; ?></td>
            <td style="padding-top:20px;"><?php echo $row["amount"]; ?></td>

        </tr>
        <?php } ?>
    </table>
</div>
<?php } else {
            ?>
<div style="padding-top: 6rem" class="container">
    <div class="jumbotron">
        <h1 class="text-center">No Payments Made.</h1>
        <p class="text-center"> Once User Make payments it will be shown here </p>
    </div>
</div>
<div style="padding-top:8rem">

    <?php
        } ?>

    </body>
    <div style="padding-top:11rem">
        <?php include 'footer.php';?>

</html>