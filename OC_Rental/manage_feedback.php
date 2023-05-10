<!DOCTYPE html>
<html>
<?php 
session_start();
?>
<head>
  <title>Manage Feedbacks</title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<style>
     .rnd{
        width: 50px;
        clip-path: circle();
    }

    @keyframes fade-in {
        from {
            /* opacity: 0; */
            transform: scale(0.5);
        }
        to {
            /* opacity: 1; */
            transform: scale(1.00);
        }
    }

    .fade-in {
    animation: fade-in 0.8s ease-out;
    }
</style>
 
<?php 
    require 'connection.php';
    $conn = Connect();

if(isset($_SESSION['login_admin'])){
    $sql1 = "SELECT * FROM feedback ORDER BY ordernumber DESC";
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
        <h1 class="text-center">Feedbacks</h1>
        <p class="text-center"> Feedbacks given by customers for rented cars </p>
      </div>
    </div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 190px;" >


<table class="table table-striped">
  <thead class="thead-dark">
<tr>

<th width="25%">Customer Username</th>
<th width="25%">Car</th>
<th width="35%">Feedback</th>
<th width="10%">Rating</th>

</tr>
</thead>
<?php
while($row = mysqli_fetch_assoc($result1)) {
            $car = $row["brand_name"].' '.$row["car_name"];
            $user = $row["customername"];
            $sql2 = "SELECT profile_image from customers WHERE customer_username = '$user'";
            $result2 = $conn->query($sql2);
                while($row2=$result2->fetch_assoc()){
                    $user_profile = $row2["profile_image"];
                }
?>
<tr>
<td><img src='<?php echo $user_profile;?>' class='img-fluid rnd fade-in' style='height: 40px; width: 40px;'>&emsp;<?php echo $row["customername"]; ?></td>
<td style="padding-top:20px;"><?php echo $car; ?></td>
<td style="padding-top:20px;"><?php echo $row["message"]; ?></td>
 </td>
 <td style="padding-top:20px;"><?php echo $row["rating"]; ?></td>
 
 <td style="padding-top:15px;"><a href="delete.php?id=<?php echo $row["ordernumber"];?>&user=feedback"><i style="padding-left:20px; color:#bf2626;" class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></td>
</tr>
<?php } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div style="padding-top: 6rem" class="container">
      <div class="jumbotron">
        <h1 class="text-center">No Feedbacks Added.</h1>
        <p class="text-center"> Once Customer Add feedback to rented car. it will be shown here. </p>
      </div>
    </div><div style="padding-top:8rem">

            <?php
        } ?>   

</body>
<div style="padding-top:11rem">
<?php include 'footer.php';?>
</html>