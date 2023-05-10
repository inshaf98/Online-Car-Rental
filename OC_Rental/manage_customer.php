<!DOCTYPE html>
<html>
<?php 
session_start();
?>
<head>
  <title>Manage Customer</title>
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
    $sql1 = "SELECT * FROM customers WHERE verify_status=1";
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
        <h1 class="text-center">Customers of OC Rental</h1>
        <!-- <p class="text-center"> Hope you enjoyed our service </p> -->
      </div>
    </div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 190px;" >


<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="8%"></th>
<th width="20%">Username</th>
<th width="25%">Customer Name</th>
<th width="30%">Customer Email</th>
<th width="15%">Phone</th>

</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><img src='<?php echo $row["profile_image"];?>' class='img-fluid rnd fade-in' style='height: 50px; width: 50px;'></td>
<td style="padding-top:20px;"><?php echo $row["customer_username"]; ?></td>
<td style="padding-top:20px;"><?php echo $row["customer_name"] ?></td>
<td style="padding-top:20px;"><?php echo $row["customer_email"]; ?></td>
 </td>
 <td style="padding-top:20px;"><?php echo $row["customer_phone"]; ?></td>
 
 <td style="padding-top:15px;"><a href="delete.php?id=<?php echo $row["customer_username"];?>&user=customer"><i style="padding-left:20px; color:#bf2626;" class="fa fa-ban fa-lg" aria-hidden="true"></i></a></td>
</tr>
<?php } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div style="padding-top: 6rem" class="container">
      <div class="jumbotron">
        <h1 class="text-center">No Customers Registered.</h1>
        <p class="text-center"> Add Some customers to the system </p>
      </div>
    </div><div style="padding-top:8rem">

            <?php
        } ?>   

</body>
<div style="padding-top:11rem">
<?php include 'footer.php';?>
</html>