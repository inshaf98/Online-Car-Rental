<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>

<?php  
if(!isset($_SESSION['login_vendor'])){
  session_destroy();
  header("location: vendorlogin.php");
}
?> 

<?php include 'assets.php';?>
<?php include 'header.php';
$login_vendor = $_SESSION['login_vendor']; 
?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<style>



    .inr {
        transition: all 0.5s ease;
    }

    .inr:hover {
        transform: scale(1.07);
    }
    
    #dCard{
        box-shadow: 3px 3px 8px hsl(0, 0%, 52%);
        border-radius:10px;
        border:2px;
        opacity: 0.9;
        height:26rem;
        width:18rem;
        overflow:hidden;
      }

      .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }
</style>

<div class="container" style="padding-top: 6rem">
      <div class="jumbotron">
        <h1 id="ajaxtest" class="text-center">My Cars</h1>
        <p class="text-center"> Your cars are displayed here </p>
      </div>
    </div>

    <div class="container">
    <div id="sec2" style="color: #777;padding-top:40px;" >
        <div class="text-center">
            <img src="assets/img/loader.gif" id="loader" width="400" style="display:none;">
        </div>
        <div class="row" id="result">
            <?php
    
                $sql = "SELECT * FROM cars c INNER JOIN vendorcars v ON c.car_id = v.car_id WHERE v.vendor_username = '$login_vendor'";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
                    $img_url = $row['car_image'];
                    $img_arr = explode (";", $img_url);
            ?>
                <div style="padding-top:0px;" class="col-md-3 mb-2">
                    <div class="card-deck">
                        <div id="dCard" class="card">
                            <img height="160px" width="250px" style="padding-left:20px; padding-top:10px;" src="<?= $img_arr[0]; ?>" class="inr" alt="img">
                            <div class="card-img-overlay">
                                <h6 class="text-light bg-info text-center rounded  p-1"><?= $row['brand_name']; ?> <?= $row['car_name']; ?></h6>
                            </div>
                            <div class="card-body">
                               <center> <h5 class="card-title">Fare: Rs.<?= $row['price_per_day']; ?>/Day </h5>
                                <p>
                                    Transmission: <?= $row['transmission']; ?><br>
                                    Fuel: <?= $row['fuel']; ?><br>
                                    Mileage: <?= $row['mileage']; ?><br>
                                    <a href="update_car.php?id=<?php echo base64_encode($row["car_id"]) ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a>

                                </p></center>
                                
                                <h6>&emsp;&emsp;Availability &emsp;&emsp;&emsp;&emsp;&emsp;<span>
                                <?php if($row['car_availability'] == "yes"){
                                    echo '<input type="checkbox" class="switch" data-value='.$row["car_id"].' data-toggle="toggle" checked data-on="Yes" data-off="No" data-style="ios"> </span></h6>';
                                    }
                                    elseif($row['car_availability'] == "no"){
                                        echo '<input type="checkbox" class="switch" data-value='.$row["car_id"].' data-toggle="toggle" value='.$row["car_id"].'data-on="Yes" data-off="No" data-style="ios"> </span></h6>';
                                    }
                                ?> 
                                
                                
                          
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>


    </div>
    <div style="padding-top:5rem"></div>
    <script>
        $("document").ready(function(){
            $(".switch").change(function(){
               var carid =  $(this).attr('data-value');
               console.log(carid);
                console.log("changed");

                if($(this).prop('checked')){
                    var status = 'true';

                }else{

                    var status = 'false';
                }

                console.log(status);

                $.ajax({
                    url:'car_status_update.php',
                    method:'POST',
                    data:{carid:carid,status:status},
                    success:function(response){
                        $("#ajaxtest").text("My Cars");
                    }
                });

            });
        });
    </script>
    <?php include 'footer.php';?>
