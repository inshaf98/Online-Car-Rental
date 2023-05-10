<html>
<?php 
 include('session_vendor.php');
if(!isset($_SESSION['login_vendor'])){
    // session_destroy();
    // header("location: vendorlogin.php");

    if(isset($_GET['vendor'])){
        // echo $_GET['vendor'];
        $vendor = $_GET['vendor'];
    }
    else{
        
        echo "No Vendor";
    }
}
else{
    $vendor = $_SESSION['login_vendor'];
}

?>
<title>Profile</title>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<style>
.rounded-border {
    /* border: 1px solid #ccc; */
    border-radius: 50%;
    height: 200px;
    width: 200px;
    max-height: 200px;
    max-width: 200px;
    min-height: 200px;
    min-width: 200px;

}

.rnd {
    width: 200px;
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

<div class="container" style="margin-top: 65px; padding-top:4rem;">
    <div class="col-md-7" style="float: none; margin: 0 auto;">

        <div class="form-area" style="border-radius: 15px;">

            <?php  
            $sql1 = "SELECT * FROM vendors WHERE vendor_username = '$vendor'";
            $result1 = mysqli_query($conn, $sql1);
    
            if(mysqli_num_rows($result1)){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $vendor_name = $row1["vendor_name"];
                    $vendor_nic = $row1["vendor_nic"];
                    $vendor_phone = $row1["vendor_phone"];
                    $vendor_email = $row1["vendor_email"];
                    $vendor_address = $row1["vendor_address"];
                    $profile_image = $row1["profile_image"];
                }
            }
      ?>


            <center>
                <h2><b><?php echo($vendor_name);?>'s Profile</b></h2><br><br>

                <div class="rounded-border">
                    <img src="<?php echo($profile_image); ?>" alt="your image description" class="img-fluid rnd fade-in"
                        style="height: 200px; width: 200px;">
                </div><br><br>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Full Name :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor_name);?>
                    </div>
                </div>
                <hr>

                <?php if(isset($_SESSION['login_vendor'])){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Username :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor);?>
                    </div>
                </div>
                <hr>
                <?php } ?>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Email Address :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor_email);?>
                    </div>
                </div>
                <hr>

                <?php if(isset($_SESSION['login_vendor'])){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <strong>NIC No. :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor_nic);?>
                    </div>
                </div>
                <hr>
                <?php } ?>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Address :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor_address);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Phone :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($vendor_phone);?>
                    </div>
                </div>
                <hr>





            </center>


        </div>
    </div>
</div>

<?php if(!isset($_SESSION['login_vendor'])){ ?>

<div class="container" style="padding-top: 6rem">
    <h2 class="text-center">Cars by <?php echo($vendor_name) ?></h2>
    <hr>
</div>

<div class="container">
    <div id="sec2" style="color: #777;padding-top:40px;">
        <!-- id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;"> -->
        <div class="text-center">
            <img src="assets/img/loader.gif" id="loader" width="400" style="display:none;">
        </div>
        <div class="row" id="result">
            <?php
                $sql = "SELECT * FROM cars c INNER JOIN vendorcars v ON c.car_id = v.car_id WHERE v.vendor_username = '$vendor'";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
                    $img_url = $row['car_image'];
                    $img_arr = explode (";", $img_url);
                
            ?>
            <div style="padding-top:0px;" class="col-md-3 mb-2">
                <div class="card-deck">
                    <div id="dCard" class="card">
                        <?php if($row['car_availability'] == 'yes'){ echo '<a href="displayfeedback.php?id='.$row["car_id"].'">'; } ?>
                        <img height="160px" width="250px" style="padding-left:20px; padding-top:10px;"
                            src="<?= $img_arr[0]; ?>" class="inr" alt="img">
                        <div class="card-img-overlay">
                            <h6 class="text-light bg-info text-center rounded  p-1"><?= $row['brand_name']; ?>
                                <?= $row['car_name']; ?></h6>
                        </div>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title">Fare: Rs.<?= $row['price_per_day']; ?>/Day </h5>
                                <p>
                                    Transmission: <?= $row['transmission']; ?><br>
                                    Fuel: <?= $row['fuel']; ?><br>
                                    Mileage: <?= $row['mileage']; ?><br>
                                </p>
                            </center><br>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>


    </div>
    <div style="padding-top:5rem"></div>

    <?php } ?>


</html>