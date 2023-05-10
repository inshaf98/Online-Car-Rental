<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Book Car </title>
<?php include 'assets.php';?>
<?php include 'header.php';?>

    <!-- RateYo -->
    <link rel="stylesheet" href="assets/rateyo/jquery.rateyo.min.css">
    <script type="text/javascript" src="assets/rateyo/jquery.rateyo.min.js"> </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<style>
    .rounded-border {
        /* border: 1px solid #ccc; */
        border-radius: 50%;
        height: 50px;
        width: 50px;
        max-height: 50px;
        max-width: 50px;
        min-height: 50px;
        min-width: 50px;
        
    }

    .car-rounded{
        border-radius: 3%;
    }

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

    .fbg{
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }
    .cmt{
        background: rgba(255,255,255,0.5);
        color:black;
    }

    #frm{
        border: none;
        /* backdrop-filter: blur(6px); */
    background: rgba(255,255,255,0.35);
       /* background-color:red; */
    }

    .swiper{
        width: 555px;
        height:400px;
    }


</style>



<body class="fbg" background="assets/img/renbg3.jpg">


    
<div class="container" style="margin-top:100px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
    
      <div class="form-area" id="frm" style="border-radius: 15px;">
        
        <br style="clear: both">

          <?php
        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $brand_name = $row1["brand_name"];
                $car_name = $row1["car_name"];
                $numberplate = $row1["numberplate"];
                $description = $row1["description"];
                $car_img = $row1["car_image"];

                $img_url = $row1['car_image'];
                 $img_arr = explode (";", $img_url);
            }
        }

        ?>

<h1><?php echo($brand_name." ".$car_name);?></h1>
            <br>
                <!-- Slider main container -->
                        <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->

                            <?php
                                foreach($img_arr as $x => $val) {
                                    echo '<div class="swiper-slide"><img class="fade-in car-rounded" style="width:555px; height:400px;" src="'.$val.'" alt="Card image cap"></div>';
                                  }
                            ?>


                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div></div>

            
           
            <?php

            //getting ratings average
            $sql4 = "SELECT * FROM feedback WHERE brand_name= '$brand_name' and car_name = '$car_name' and numberplate='$numberplate'";
            $result4 = mysqli_query($conn, $sql4);

            //Getting Vendor Username
            $ven_uname_query = "SELECT vendor_username FROM vendorcars WHERE car_id=$car_id";
            $row_uname = mysqli_fetch_assoc($conn->query($ven_uname_query) );
            $ven_username = $row_uname['vendor_username'];
            
            //Getting Vendor Profile Image
            $sql_vend_image = "SELECT vendor_name, profile_image FROM vendors WHERE vendor_username='$ven_username'";
            $row_vend_image = mysqli_fetch_assoc($conn->query($sql_vend_image) );
            $vend_img = $row_vend_image['profile_image'];
            $vend_name = $row_vend_image['vendor_name'];


            
            $count=0;
            $ratings=0;
            if(mysqli_num_rows($result4)>0){
                while($row4 = mysqli_fetch_assoc($result4)) {
                    $rating = $row4["rating"];
                    $ratings=$ratings+$rating;
                    $count++;
                }
            }

            if($ratings == 0){
                $rating2=0;
            }
            else{
                $rating2 = $ratings/$count;
            }

            ?>

                <script>
                $(function () {

                    $("#rateYo").rateYo({
                        
                    rating: <?php echo($rating2) ?>

                    });
                });
                var readOnly = $("#rateYo").rateYo("option", "readOnly"); //returns true
                </script>


           <div style="padding-top:15px;" class="row">
           
           <div class="col-md-6">
                   <div class="card cmt" style="border: none; border-radius:10px; height:6rem; width: 18rem; overflow:hidden;">
                  <?php echo "<a href='profile_vendor.php?vendor=$ven_username'>" ?>
                            <div class="col-xs-3" style="padding-top:14px;">
                            <img src="<?php echo($vend_img); ?>" alt="your image description" class="img-fluid" style="height: 60px; width: 60px; clip-path: circle();">&emsp;
                            </div>
                            <div class="col-xs-8" style="padding-bottom:14px; padding-left:20px;">
                            <span style="font-size:12px;">Vendor</span>
                            <br><p style="font-size:17px;"><?php echo($vend_name); ?></p></a>
                            </div>
                        <!-- <center><p style="font-size:15px;">Vendor</p> -->
                    </div>
               </div>

               <div class="col-md-6">
                   <div class="card cmt" style="border: none;  height:6rem; width: 18rem; overflow:hidden; border-radius:10px;">
                            <center><p style="font-size:12px;">Rating</p>
                        <div data-rateyo-read-only="true" id="rateYo"
                        data-rateyo-spacing="5px"
                    data-rateyo-star-width="22px"></div>
                        <p style="font-size:20px; padding-top:4px;"><?php echo round($rating2, 1); ?></p></center>
                        </div>
               </div>


           </div>
            <!-- <h4 style="color:black;" > Rating:&nbsp; </h4>  -->
            <h4 style="color:black;"> Reviews:&nbsp; </h4>
            <div class="form-area cmt" style="border: none; border-radius:10px;">  
            <?php

            //getting feedback
            $sql5 = "SELECT * FROM feedback WHERE brand_name= '$brand_name' and car_name = '$car_name' and numberplate='$numberplate'";
            $result5 = mysqli_query($conn, $sql5);
                
            if(mysqli_num_rows($result5)>0){
                while($row5 = mysqli_fetch_assoc($result5)) {
                    $customername = $row5["customername"];
                    $rating = $row5["rating"];
                    $message = $row5["message"];

                    $sql_cust_image = "SELECT profile_image FROM customers WHERE customer_username='$customername'";
                    // $row_image = mysql_query($sql_cust_image);
                    $row_image = mysqli_fetch_assoc($conn->query($sql_cust_image) );
                    $cust_img = $row_image['profile_image'];


            ?>

            <div class="row">
                <div class="col-md-1">
                    <div class="rounded-border">
                        <img src="<?php echo($cust_img); ?>" alt="your image description" class="img-fluid rnd fade-in" style="height: 40px; width: 40px;">
                    </div>  
                </div>
                <div class="col-md-11">
                    <b>&nbsp;<?php echo($customername);?></b><br>
                    &nbsp;<?php echo($message);?> <br><br>
                </div>
            </div>
            
               
            <?php
                }}
            else
            { ?>
        
                <h1> No Feedbacks </h1>
        <?php    }
        ?>
         </div>
          <!-- </div>      -->
        
        
        
        
        

             
          <a href="booking.php?id=<?php echo($car_id) ?>"><button class="btn btn-warning pull-right">Rent Now</button></a>
           
      </div>
    </div>
    <script>
        const swiper = new Swiper('.swiper', {
        loop: false,

        pagination: {
            el: '.swiper-pagination',
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        });
    </script>  
</body>
<?php include 'footer.php';?>
</html>