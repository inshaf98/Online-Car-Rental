<!DOCTYPE html>
<html>

<?php 
include('session_vendor.php'); 
if(!isset($_SESSION['login_vendor'])){
  session_destroy();
  header("location: vendorlogin.php");
}
?> 

<head>

<script>
  $("i").click(function () {
  $("input[type='file']").trigger('click');
});

$('input[type="file"]').on('change', function() {
  var val = $(this).val();
  $(this).siblings('span').text(val);
})
</script>


<?php include 'assets.php';?>
<?php include 'header.php';?>


    <div class="container" style="margin-top: 100px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area" style="border-radius: 15px;">
        <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Please Provide Your Car Details. </h3>

          <div class="form-group">
            <input type="text" class="form-control" id="car_brandname" name="car_brandname" placeholder="Car Brand Name " required autofocus="">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Car Name " required autofocus="">
          </div>

          <div class="form-group">
            <select class="form-control" name="vehicle_type" required>
              <option value="" disabled selected hidden>Vehicle Type</option>
              <option value="Sedan">Sedan</option>
              <option value="Wagon">Wagon</option>
              <option value="SUV">SUV</option>
              <option value="Van">Van</option>
              <option value="Van">Mini Car</option>
              <option value="Special">Special</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="car_numberplate" name="car_numberplate" placeholder="Vehicle Number Plate" required>
          </div>     

          <!-- <div class="form-group">
            <input type="text" class="form-control" id="price" name="price" placeholder="Fare per KM (Rs)" required>
          </div> -->

          <div class="form-group">
            <input type="text" class="form-control" id="price_per_day" name="price_per_day" placeholder="Fare per day (Rs)" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="car_mileage" name="car_mileage" placeholder="Car Mileage (KM) " required autofocus="">
          </div>

          <div class="form-group">
            <!-- <input type="text" class="form-control" id="car_transmission" name="car_transmission" placeholder="Car Transmission " required autofocus=""> -->
            <select class="form-control" name="car_transmission" id="car_transmission" required>
              <option value="1" disabled selected hidden>Select the Transmission Type</option>
              <option value="Auto">Auto</option>
              <option value="Manual">Manual</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="car_seat" name="car_seat" placeholder="Car Seat " required autofocus="">
          </div>

          <div class="form-group">
            <input type="number" class="form-control" id="car_luggage" name="car_luggage" placeholder="Car Luggage (Litres) " required autofocus="">
          </div>

          <div class="form-group">
            <!-- <input type="text" class="form-control" id="car_transmission" name="car_transmission" placeholder="Car Transmission " required autofocus=""> -->
            <select class="form-control" name="car_fuel" id="car_fuel" required>
              <option value="1" disabled selected hidden>Select the Fuel Type</option>
              <option value="Petrol">Petrol</option>
              <option value="Diesel">Diesel</option>
              <option value="Hybrid">Hybrid</option>
            </select>
          </div>

          <div class="form-group">
            <textarea class="form-control" id="car_description" name="car_description" placeholder="Car Description" required autofocus="" rows="3"></textarea>
          </div>

          
          <div class="form-group">
            <label>Car Images <span style="color:grey; font-size:11px;">(Add Atleast 3 Images)</span> </label>
            <div class="row">
              <div class="col-md-2">
              <label for="firstimg"><i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i></label>
              <input name="uploadedimage1" id="firstimg" type="file" required style="display: none;visibility: none;" onchange="getImage1(this.value);">
              <div id="display-image"></div>
              </div>

              <div class="col-md-2">
              <label for="secondimg"><i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i></label>
              <input name="uploadedimage2" id="secondimg" type="file" required style="display: none;visibility: none;" onchange="getImage2(this.value);">
              <div id="display-image2"></div>
              </div>

              <div class="col-md-2">
              <label for="thirdimg"><i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i></label>
              <input name="uploadedimage3" id="thirdimg" type="file" required style="display: none;visibility: none;" onchange="getImage3(this.value);">
              <div id="display-image3"></div>
              </div>

              <div class="col-md-2">
              <label for="fourthimg"><i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i></label>
              <input name="uploadedimage4" id="fourthimg" type="file" style="display: none;visibility: none;" onchange="getImage4(this.value);">
              <div id="display-image4"></div>
              </div>

              <div class="col-md-2">
              <label for="fifthimg"><i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i></label>
              <input name="uploadedimage5" id="fifthimg" type="file" style="display: none;visibility: none;" onchange="getImage5(this.value);">
              <div id="display-image5"></div>
              </div>
            </div>

            
          </div>
           <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Submit for Rental</button>    
        </form>
      </div>
    </div>


        <div class="col-md-12" style="float: none; margin: 0 auto;">
    <div class="form-area" style="padding: 0px 100px 100px 100px; border-radius: 15px;">
        <form action="" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Cars </h3>
<?php
// Storing Session
$user_check=$_SESSION['login_vendor'];
$sql = "SELECT * FROM cars WHERE car_id IN (SELECT car_id FROM vendorcars WHERE vendor_username='$user_check');";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  ?>
<div style="overflow-x:auto;">
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th></th>
        <th width="24%"> Brand Name</th>
        <th width="24%"> Name</th>
        <th width="15%"> Numberplate </th>
        <!-- <th width="13%"> Fare (/km) </th> -->
        <th width="13%"> Fare (/day)</th>
        <th width="13%"> Seats </th>
        <th width="13%"> Fuel </th>
        <th width="13%"> Transmission </th>
        <th width="1%"> Availability </th>
      </tr>
    </thead>

    <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
        $car_id=$row["car_id"];
    ?>

  <tbody>
    <tr>
      <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
      <td><?php echo $row["brand_name"]; ?></td>
      <td><?php echo $row["car_name"]; ?></td>
      <td><?php echo $row["numberplate"]; ?></td>
      <td><?php echo $row["price_per_day"]; ?></td>
      <td><?php echo $row["seats"]; ?></td>
      <td><?php echo $row["fuel"]; ?></td>
      <td><?php echo $row["transmission"]; ?></td>
      <td><?php echo $row["car_availability"]; ?></td>
      <td><a href="deletecar.php?id=<?php echo base64_encode($car_id) ?>">Delete</a></td>

    </tr>
  </tbody>
  <?php } ?>
  </table>
  </div>
    <br>
  <?php } else { ?>
  <h4><center>0 Cars available</center> </h4>
  <?php } ?>
        </form>
</div>        
        </div>
    </div>
</body>

<script>
  function getImage1(imagename)
 {
  var img1=imagename.replace(/^.*\\/,"");
  $('#display-image').html(img1);
 }
 function getImage2(imagename){
  var img2=imagename.replace(/^.*\\/,"");
  $('#display-image2').html(img2);
 }

 function getImage3(imagename){
  var img3=imagename.replace(/^.*\\/,"");
  $('#display-image3').html(img3);
}

function getImage4(imagename){
  var img4=imagename.replace(/^.*\\/,"");
  $('#display-image4').html(img4);
}

function getImage5(imagename){
  var img5=imagename.replace(/^.*\\/,"");
  $('#display-image5').html(img5);
}
</script>
<?php include 'footer.php';?>
</html>