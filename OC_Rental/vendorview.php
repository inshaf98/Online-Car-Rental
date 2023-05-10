<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<?php include 'assets.php';?>
<?php include 'header.php';?>
<?php $login_vendor = $_SESSION['login_vendor']; 

    // $sql1 = "SELECT * FROM rentedcars rc, vendorcars cc, customers c, cars WHERE cc.vendor_username = '$login_vendor' AND cc.car_id = rc.car_id AND rc.return_status = 'R' AND c.customer_username = rc.customer_username AND cc.car_id = cars.car_id";

    $sql1 = "SELECT v.car_id, c.brand_name, c.car_name, rc.customer_username, rc.booking_date, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.no_of_days, rc.total_amount FROM vendorcars v INNER JOIN cars c ON v.car_id = c.car_id INNER JOIN rentedcars rc ON v.car_id = rc.car_id WHERE v.vendor_username = '$login_vendor'";

    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>

<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1 class="text-center">Your Bookings</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
    </div>
</div>

<div class="table-responsive" style="padding-left: 200px; padding-right: 200px;">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th width="15%">Car</th>
                <th width="10%">Customer</th>
                <th width="12%">Booking Date</th>
                <th width="12%">Rent Start Date</th>
                <th width="12%">Rent End Date</th>
                <th width="12%">Total Amount</th>
            </tr>
        </thead>
        <?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
        <tr>
            <td><?php echo $row["brand_name"],' ',$row["car_name"]; ?></td>
            <td><?php echo $row["customer_username"]; ?></td>
            <td><?php echo $row["booking_date"] ?></td>
            <td><?php echo $row["rent_start_date"] ?></td>
            <td><?php echo $row["rent_end_date"]; ?></td>
            <td>Rs. <?php echo $row["total_amount"]; ?></td>
        </tr>
        <?php        } ?>
    </table>
</div>
<?php } else {
            ?>
<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1>No booked cars</h1>
        <p> Once customer booked your car it will be shown here.<?php echo $conn->error; ?> </p>
    </div>
    <div style="padding-top:8rem"></div>
</div>

<?php
        } ?>

</body>
<div style="padding-top:10rem"></div>
<?php include 'footer.php';?>

</html>