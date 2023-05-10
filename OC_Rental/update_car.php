<!DOCTYPE html>
<html>

<?php 
include('session_vendor.php'); 
if(!isset($_SESSION['login_vendor'])){
  session_destroy();
  header("location: vendorlogin.php");
}
?>
<style>
.carimg {
    width: 70px;
    height: 70px;
}
</style>

<head>

    <?php include 'assets.php';?>
    <?php include 'header.php';?>
    <?php 
$idd = $_GET["id"]; 
$id = base64_decode($idd);
$sql1 = "SELECT * FROM cars WHERE car_id=".$id;

$result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $brand_name = $row1["brand_name"];
                $car_name = $row1["car_name"];
                $vehicle_type = $row1["vehicle_type"];
                $price_per_day = $row1["price_per_day"];
                $numberplate = $row1["numberplate"];
                $mileage = $row1["mileage"];
                $transmission = $row1["transmission"];
                $seats = $row1["seats"];
                $luggage = $row1["luggage"];
                $fuel = $row1["fuel"];
                $description = $row1["description"];

                $img_url = $row1['car_image'];
                 $img_arr = explode (";", $img_url);
            }
        }

?>



    <div class="container" style="margin-top: 100px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area" style="border-radius: 15px;">
                <form role="form" action="update_car_process.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Please Update Your Car
                        Details. </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $brand_name ?>" id="car_brandname"
                            name="car_brandname" placeholder="Car Brand Name " required autofocus="">
                    </div>

                    <input type="hidden" name="car_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="img_url" value="<?php echo $img_url; ?>">

                    <div class="form-group">
                        <input type="text" value="<?php echo $car_name ?>" class="form-control" id="car_name"
                            name="car_name" placeholder="Car Name " required autofocus="">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="vehicle_type">
                            <option value="<?php echo $vehicle_type ?>" selected><?php echo $vehicle_type ?></option>
                            <option value="Sedan">Sedan</option>
                            <option value="Wagon">Wagon</option>
                            <option value="SUV">SUV</option>
                            <option value="Van">Van</option>
                            <option value="Van">Mini Car</option>
                            <option value="Special">Special</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $numberplate ?>" id="car_numberplate"
                            name="car_numberplate" placeholder="Vehicle Number Plate" required>
                    </div>

                    <!-- <div class="form-group">
            <input type="text" class="form-control" id="price" name="price" placeholder="Fare per KM (Rs)" required>
          </div> -->

                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $price_per_day ?>" id="price_per_day"
                            name="price_per_day" placeholder="Fare per day (Rs)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $mileage ?>" id="car_mileage"
                            name="car_mileage" placeholder="Car Mileage (KM) " required autofocus="">
                    </div>

                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="car_transmission" name="car_transmission" placeholder="Car Transmission " required autofocus=""> -->
                        <select class="form-control" name="car_transmission" id="car_transmission" required>
                            <option value="<?php echo $transmission ?>" selected><?php echo $transmission ?></option>
                            <option value="Auto">Auto</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $seats ?>" id="car_seat"
                            name="car_seat" placeholder="Car Seat " required autofocus="">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" value="<?php echo $luggage ?>" id="car_luggage"
                            name="car_luggage" placeholder="Car Luggage (Litres) " required autofocus="">
                    </div>

                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="car_transmission" name="car_transmission" placeholder="Car Transmission " required autofocus=""> -->
                        <select class="form-control" name="car_fuel" id="car_fuel" required>
                            <option value="<?php echo $fuel ?>" selected><?php echo $fuel ?></option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="car_description" name="car_description"
                            placeholder="Car Description" required autofocus=""
                            rows="3"><?php echo $description ?></textarea>
                    </div>


                    <div class="form-group">
                        <label>Car Images</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="firstimg"><img class="carimg" src="<?php echo $img_arr[0] ?>"
                                        alt=""></label>
                                <input name="uploadedimage1" id="firstimg" type="file"
                                    style="display: none;visibility: none;" onchange="getImage1(this.value);">
                                <div id="display-image"></div>
                            </div>

                            <div class="col-md-2">
                                <label for="secondimg">
                                    <?php
              if (array_key_exists(1, $img_arr)){
                    echo '<img class="carimg" src="'.$img_arr[1].'" alt="">'; 
                }
                else{ 
                    echo '<i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i>';
                }
            ?>
                                </label>
                                <input name="uploadedimage2" id="secondimg" type="file"
                                    style="display: none;visibility: none;" onchange="getImage2(this.value);">
                                <div id="display-image2"></div>
                            </div>

                            <div class="col-md-2">
                                <label for="thirdimg">
                                    <?php
              if (array_key_exists(2, $img_arr)){
                    echo '<img class="carimg" src="'.$img_arr[2].'" alt="">'; 
                }
                else{ 
                    echo '<i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i>';
                }
            ?>
                                </label>
                                <input name="uploadedimage3" id="thirdimg" type="file"
                                    style="display: none;visibility: none;" onchange="getImage3(this.value);">
                                <div id="display-image3"></div>
                            </div>

                            <div class="col-md-2">
                                <label for="fourthimg">
                                    <?php
              if (array_key_exists(3, $img_arr)){
                    echo '<img class="carimg" src="'.$img_arr[3].'" alt="">'; 
                }
                else{ 
                    echo '<i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i>';
                }
            ?>
                                </label>
                                <input name="uploadedimage4" id="fourthimg" type="file"
                                    style="display: none;visibility: none;" onchange="getImage4(this.value);">
                                <div id="display-image4"></div>
                            </div>

                            <div class="col-md-2">
                                <label for="fifthimg">
                                    <?php
              if (array_key_exists(4, $img_arr)){
                    echo '<img class="carimg" src="'.$img_arr[4].'" alt="">'; 
                }
                else{ 
                    echo '<i class="fa fa-plus" style="font: size 24px; ;border: 1px solid black;padding: 25px;cursor: pointer;"></i>';
                }
            ?>
                                </label>
                                <input name="uploadedimage5" id="fifthimg" type="file"
                                    style="display: none;visibility: none;" onchange="getImage5(this.value);">
                                <div id="display-image5"></div>
                            </div>
                        </div>


                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Update
                        Car</button>
                </form>
            </div>
        </div>

        </body>
        <script>
        function getImage1(imagename) {
            var img1 = imagename.replace(/^.*\\/, "");
            $('#display-image').html(img1);
        }

        function getImage2(imagename) {
            var img2 = imagename.replace(/^.*\\/, "");
            $('#display-image2').html(img2);
        }

        function getImage3(imagename) {
            var img3 = imagename.replace(/^.*\\/, "");
            $('#display-image3').html(img3);
        }

        function getImage4(imagename) {
            var img4 = imagename.replace(/^.*\\/, "");
            $('#display-image4').html(img4);
        }

        function getImage5(imagename) {
            var img5 = imagename.replace(/^.*\\/, "");
            $('#display-image5').html(img5);
        }
        </script>
        <?php include 'footer.php';?>

</html>