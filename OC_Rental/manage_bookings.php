<!DOCTYPE html>
<html>
<?php 
session_start();
?>

<head>
    <title>Manage Bookings</title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>


<?php 
    require 'connection.php';
    $conn = Connect();

if(isset($_SESSION['login_admin'])){
    $sql1 = "SELECT * FROM rentedcars ORDER BY id DESC";
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
        <h1 class="text-center">OC Rental Bookings</h1>
        <p class="text-center"> All the bookings made to OC Rentals are here </p>
    </div>
</div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 190px;">


    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th width="20%">Customer Username</th>
                <th width="15%">Booking Date</th>
                <th width="15%">Rent Start Date</th>
                <th width="15%">Rent End Date</th>
                <th width="15%">Car Return Date</th>
                <th width="15%">Fare</th>
                <th width="15%">Action</th>

            </tr>
        </thead>
        <?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
        <tr>
            <td style="padding-top:20px;"><?php echo $row["customer_username"]; ?></td>
            <td style="padding-top:20px;"><?php echo $row["booking_date"] ?></td>
            <td style="padding-top:20px;"><?php echo $row["rent_start_date"]; ?></td>
            <td style="padding-top:20px;"><?php echo $row["rent_end_date"] ?></td>
            <?php
    if($row["return_status"] == "NR"){?>
            <td style="padding-top:20px;">N/R</td>
            <?php
    }
    else{?>
            <td style="padding-top:20px;"><?php echo $row["car_return_date"]; ?></td>
            <?php
    }
 ?>

            </td>

            <?php
    if($row["return_status"] == "R"){?>
            <td style="padding-top:20px;"><?php echo $row["fare"]; ?></td>
            <?php
    }
    else{?>
            <td style="padding-top:20px;">N/A</td>
            <?php
    }
 ?>

            <?php
    $today = date("Y-m-d");
    if($row["rent_start_date"] > $today){?>
            <td style="padding-top:15px;"><a href="delete.php?id=<?php echo $row["id"];?>&user=booking"><i
                        style=" color:#bf2626;" class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></td>
            <?php
    }
    else{
        echo '<td style="padding-top:20px;">N/A</td>';
    }
 ?>

        </tr>
        <?php } ?>
    </table>
</div>
<?php } else {
            ?>
<div style="padding-top: 6rem" class="container">
    <div class="jumbotron">
        <h1 class="text-center">No Bookings Made</h1>
        <p class="text-center"> Once a customer booked it will be shown here </p>
    </div>
</div>
<div style="padding-top:8rem">

    <?php
        } ?>

    </body>
    <div style="padding-top:11rem">
        <?php include 'footer.php';?>

</html>