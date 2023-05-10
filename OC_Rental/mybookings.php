<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
  <title>My Bookings</title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>
 
<?php $login_customer = $_SESSION['login_customer']; 

    $sql1 = "SELECT c.car_name, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.id FROM rentedcars rc, cars c
    WHERE rc.customer_username='$login_customer' AND c.car_id=rc.car_id AND c.car_availability='no' AND rc.return_status='NR' AND rc.rent_start_date >= CURDATE()";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
<div class="container" style="padding-top: 6rem">
      <div class="jumbotron">
        <h1 class="text-center">Watchout Your Bookings Here</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
      </div>
    </div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 100px;" >

<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="30%">Car</th>
<th width="20%">Rent Start Date</th>
<th width="20%">Rent End Date</th>
<th width="10%">Action</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["car_name"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"]; ?></td>
 </td>
<td><a href="cancel.php?id=<?php echo $row["id"];?>"> Cancel </a></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div style="padding-top: 6rem" class="container">
      <div class="jumbotron">
        <h1 class="text-center">No cars to Cancel.</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
      </div>
    </div><div style="padding-top:8rem">

            <?php
        } ?>   

</body>
<div style="padding-top:11rem">
<?php include 'footer.php';?>
</html>