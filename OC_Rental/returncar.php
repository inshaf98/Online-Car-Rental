<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<!-- RateYo -->
<link rel="stylesheet" href="assets/rateyo/jquery.rateyo.min.css">
<script type="text/javascript" src="assets/rateyo/jquery.rateyo.min.js"> </script>

<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $id = $_GET["id"];
 $sql1 = "SELECT c.car_name, c.numberplate, rc.rent_start_date, rc.rent_end_date, rc.fare
 FROM rentedcars rc, cars c
 WHERE id = '$id' AND c.car_id=rc.car_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $car_name = $row["car_name"];
        $numberplate = $row["numberplate"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");

        $car_return_date = date('Y-m-d');

        function dateDifference($start, $end) {
          $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
      }

      $extra_days = dateDifference("$rent_end_date", "$car_return_date");
      $total_fine = $extra_days*(($fare / 100)*125);

      $duration = dateDiff("$rent_start_date","$rent_end_date");


    }
}
?>
<div class="container" style="padding-top: 6rem">
    <div class="col-md-7" style="float: none; margin: 0 auto;">
        <div class="form-area">
            <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
                <br style="clear: both">
                <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Journey Details </h3>
                <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Please fill the below form </h6>

                <h5><b>Car:&nbsp;</b> <?php echo($car_name);?></h5>

                <h5><b>Vehicle Number:&nbsp;</b> <?php echo($numberplate);?></h5>

                <h5><b>Rent date:&nbsp;</b> <?php echo($rent_start_date);?></h5>

                <h5><b>End Date:&nbsp;</b> <?php echo($rent_end_date);?></h5>

                <h5><b>Number of Day(s):&nbsp;</b> <?php echo($no_of_days);?></h5>

                <h5><b>Fare:&nbsp;</b> Rs. <?php echo ($fare . "/day");?>

                    <?php
            if($extra_days>0) { ?>
                    <b>
                        <h5> Fine:&nbsp;
                    </b> Rs. <?php echo ($total_fine . " for extra ".$extra_days." Days");?>

                    <?php
           }
           ?>

                </h5><br>
                <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
                <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">
                <div class="form-group">
                    <textarea class="form-control" id="feedback" name="feedback" placeholder="Feedback" required
                        autofocus="" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <p style="font-size:16px;">Ratings:</p>
                    </div>
                    <div class="col-md-4">

                        <div class="rateyo" id="rating" data-rateyo-rating="0" data-rateyo-full-star="true"
                            data-rateyo-num-stars="5" data-rateyo-spacing="5px" data-rateyo-star-width="22px"
                            data-rateyo-score="0">
                        </div>

                        <!-- <span class="results">0</span> -->
                        <input type="hidden" name="rating">
                    </div>
                </div>


                <script>
                $(function() {
                    $(".rateyo").rateYo({

                        multiColor: {
                            "startColor": "#FF0000", //RED
                            "endColor": "#FD9633" //Yellow
                        }

                    }).on("rateyo.change", function(e, data) {
                        var rating = data.rating;
                        $(this).parent().find('.score').text('score :' + $(this).attr(
                            'data-rateyo-score'));
                        $(this).parent().find('.result').text('rating :' + rating);
                        $(this).parent().find('input[name=rating]').val(
                        rating); //add rating value to input field
                    });
                });
                </script>


                <!-- <select name="ratings_from_dropdown" ng-model="myVar2">
                    <option value="1">1
                    <option value="2">2
                    <option value="3">3
                    <option value="4">4
                    <option value="5">5
                </select> -->
                <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">
            </form>
        </div>
    </div>

</div>

</body>
<?php include 'footer.php';?>

</html>