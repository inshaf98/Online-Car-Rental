<!DOCTYPE html>
<?php include 'assets.php';?>

<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>
<?php include 'header.php';?>
<title>Book Car </title>

<head>

    <style>
    .car-rounded {
        border-radius: 3%;
    }

    .rnd {
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

    .fbg {
        height: 100%;
        background-position: center;
        /* background-repeat: no-repeat; */
        background-size: cover;

    }

    #frm {
        color: black;
        border: none;
        /* backdrop-filter: blur(6px); */
        background: rgba(255, 255, 255, 0.35);
        /* background-color:red; */
    }
    </style>

</head>

<body class="fbg" background="assets/img/renbg3.jpg">




    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">

            <div class="form-area" id="frm" style="border-radius: 15px;">
                <form role="form" id="rentForm" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $brand_name = $row1["brand_name"];
                $car_name = $row1["car_name"];
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

                    <h1><?php echo($brand_name." ".$car_name);?></h1>
                    <br>
                    <img class="car-rounded" style="width:550px; height:400px;" src="<?php echo($img_arr[0]); ?>"
                        alt="Card image cap">




                    <!-- <div class="form-group"> -->

                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <h5 style="color:black"> Number Plate:&nbsp;<b> <?php echo($numberplate);?></b></h5>
                    <h5 style="color:black"> Mileage:&nbsp;<b> <?php echo($mileage);?></b></h5>
                    <h5 style="color:black"> Transmission:&nbsp;<b> <?php echo($transmission);?></b></h5>
                    <h5 style="color:black"> Seats:&nbsp;<b> <?php echo($seats);?></b></h5>
                    <h5 style="color:black"> Luggage:&nbsp;<b> <?php echo($luggage);?></b></h5>
                    <h5 style="color:black"> Fuel:&nbsp;<b> <?php echo($fuel);?></b></h5>
                    <h5 style="color:black"> Description:&nbsp;<b> <?php echo($description);?></b></h5>

                    <!-- </div>      -->
                    <!-- <div class="form-group"> -->
                    <?php $today = date("Y-m-d", time() + 86400) ?>
                    <label>
                        <h5 style="color:black">Start Date:</h5>
                    </label>
                    <input type="date" id="rst" name="rent_start_date" min="<?php echo($today);?>" required="">
                    &nbsp;
                    <label>
                        <h5 style="color:black">End Date:</h5>
                    </label>
                    <input type="date" id="red" name="rent_end_date" min="<?php echo($today);?>" required=""><br>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span id="dError" style="color:red;font-size: 12px;">Please
                        input a valid date</span>
                    <!-- </div>      -->


                    <div ng-switch="myVar">
                        <div ng-switch-default>
                        </div>
                        <div>
                            <h5 style="color:black">Fare: <b><?php echo("Rs. " . $price_per_day . "/day");?></b> (Paid
                                to vendor)<h5>
                                    <h5 style="color:black"> Reservation Fee:&nbsp;<b> <?php echo("500/-");?></b></h5>
                        </div>
                    </div>

                    <br><input style="padding-top:10px;" id="valCheck" type="button" name="btnform" value="Rent Now"
                        class="btn btn-warning pull-right">
                    <div class="pay" style="max-width: 28rem; padding-left:8rem;">
                        <div id="cbtn1" class="chk-btn" style="padding-top:30px;"></div>
                    </div>
            </div>
            <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
            <input type="hidden" id="tr_id" name="tr_id" value="">
            <input type="hidden" id="amount" name="amount" value="">
            </form>

        </div>

        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6 style="color:black"><strong>Note:</strong> You will be charged with extra <b>25%</b> for each day after
                the due date ends.</h6>
        </div>
        <!-- to display feedback -->
    </div>

</body>

<script>
$(document).ready(function() {
    $('#dError').hide();
    $('.pay').hide();
    $("#valCheck").click(function() {
        console.log('click');
        var rst = document.getElementById("rst").value;
        var red = document.getElementById("red").value;
        var ToDate = new Date();

        if (new Date(rst).getTime() >= ToDate.getTime()) {
            if (new Date(red).getTime() > new Date(rst).getTime()) {
                $('.pay').show();
                $('#valCheck').hide();

            } else {
                $("#dError").show().delay(4000).fadeOut();
            }
        } else {
            $("#dError").show().delay(4000).fadeOut();
        }

    });
});
</script>

<script
    src="https://www.paypal.com/sdk/js?client-id=AawdWm6QdHMghylJ0dJA6RBcGUNEGKObZq8uIXO_ZzDSFDV6BFugMtpHQBWURdXtyBKZdzNW0D0GFV_z&currency=USD">
</script>
<script src="assets/js/paypal.js"></script>

<?php include 'footer.php';?>

</html>