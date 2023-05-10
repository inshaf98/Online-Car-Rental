<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<body>
<div style="padding-top:60px">
<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $id = $_GET["id"];
 $sql1 = "SELECT c.car_name, c.car_id, c.numberplate, rc.rent_start_date, rc.rent_end_date, rc.fare
 FROM rentedcars rc, cars c
 WHERE id = '$id' AND c.car_id=rc.car_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $car_id = $row["car_id"];
        $car_name = $row["car_name"];
        $numberplate = $row["numberplate"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
    }
}
?>
    <div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form">
        <br style="clear: both">
          <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Cancel Booking </h3>
          <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Fill the below form to cancel the booking</h6>

           <h5> Car:&nbsp;  <?php echo($car_name);?></h5>

           <h5> Vehicle Number:&nbsp;  <?php echo($numberplate);?></h5>

           <h5> Rent date:&nbsp;  <?php echo($rent_start_date);?></h5>

           <h5> End Date:&nbsp;  <?php echo($rent_end_date);?></h5>

           <p style="display:none;" id="carid"><?php echo($car_id); ?></p>

           <p style="display:none;" id="rcid"><?php echo($id); ?></p>

          <div class="form-group">
            <textarea class="form-control" id="reason" name="reason" placeholder="Cancellation Reason" required autofocus="" rows="3"></textarea>
          </div>
      
          <center><button type="button" id="submit" value="submit" style="text-align:center; padding-left: 50px; padding-right: 60px;" class="btn btn-primary mx-auto d-block">Submit</button></center>
        </form>
      </div>
    </div>
   
    </div>
          </div>
</body>
<script>
  $(document).ready(function() {
    $("#submit").click(function(){
        console.log('click');

      setTimeout(function(){
          var action = 'data';
          var carid = document.getElementById("carid").textContent;
          var rcid = document.getElementById("rcid").textContent;


      $.ajax({
          url:'cancel2.php',
          method:'POST',
          data:{action:action,carid:carid,rcid:rcid},
          success:function(response){

            Swal.fire({
                  icon: 'success',
                  title: 'Cancelled',
                  text: "Your Booking Has Been Cancelled",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                })

            setTimeout(function(){
                window.location = "mybookings.php";
              }, 2500);
          }
      });
      }, 500); 
    }); 
});
</script>
<?php include 'footer.php';?>
</html>