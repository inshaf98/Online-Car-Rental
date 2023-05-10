  <!DOCTYPE html>
<html>
<?php 
session_start();
?>
<head>
  <title>My Inquiry</title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>
 
<?php 

include('session_admin.php');
if(isset($_SESSION['login_customer'])){
    $login_customer = $_SESSION['login_customer']; 
    $sql1 = "SELECT * FROM inquiry WHERE customer_username='$login_customer'";
}
elseif(isset($_SESSION['login_admin'])){
    $sql1 = "SELECT * FROM inquiry";
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
        <h1 class="text-center">Watchout the Inquiries Here</h1>
        <!-- <p class="text-center"> Hope you enjoyed our service </p> -->
      </div>
    </div>

<div class="table-responsive" style="padding-left: 190px; padding-right: 190px;" >


<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="20%">Customer Username</th>
<th width="15%">Date</th>
<th width="45%">Query</th>
<th width="15%">Status</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["customer_username"]; ?></td>
<td><?php echo $row["date"] ?></td>
<td><?php echo $row["query"]; ?></td>
 </td>
 <?php 
    if($row["status"] == 0){
        echo '<td><i style="padding-left:20px;" class="fa fa-clock-o fa-lg" aria-hidden="true"></i></td>';
    }
    else{
        echo '<td><i style="padding-left:20px;" class="fa fa-check-circle fa-lg" aria-hidden="true"></i></td>';

    }
 ?>
 <td><a href="view_inquiry.php?id=<?php echo $row["inquiry_id"];?>"><i style="padding-left:20px;" class="fa fa-chevron-right fa-lg" aria-hidden="true"></i></a></td>
</tr>
<?php } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div style="padding-top: 6rem" class="container">
      <div class="jumbotron">
        <h1 class="text-center">No Inquiries Found.</h1>
      </div>
    </div><div style="padding-top:8rem">

            <?php
        } ?>   

</body>
<div style="padding-top:11rem">
<?php include 'footer.php';?>
</html>