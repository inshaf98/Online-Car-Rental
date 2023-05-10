    <?php 
    session_start(); 
    require 'connection.php';
    $conn = Connect();

    $minimum_range = 0;
    $maximum_range = 40000;

    ?>
    <?php include 'assets.php';?>
    <?php include 'header.php';?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





    <style>
.inr {
    transition: all 0.5s ease;
}

.inr:hover {
    transform: scale(1.07);
}

#dCard {
    box-shadow: 3px 3px 8px hsl(0, 0%, 52%);
    border-radius: 10px;
    border: 2px;
    opacity: 0.9;
    height: 23rem;
    width: 18rem;
    overflow: hidden;
}

.select2-container .select2-selection--single {
    height: 40px !important;
}

.select2-selection__arrow b {
    display: none !important;
}

.ui-widget-header {
    background: #83CFED;
}

.ui-slider-horizontal {
    height: .6em;
}

.ui-slider-horizontal {
    margin-bottom: 15px;
    width: 90%;
}
    </style>

    <script>
$(document).ready(function() {
    $('.selectClass').select2({
        placeholder: 'Search By Location',
        allowClear: true,
    });
});
    </script>

    <script>
$(document).ready(function() {
    // $("#search").click(function(){ 
    $("#location").change(function() {
        console.log('click');

        setTimeout(function() {
            var action = 'data';
            var s = document.getElementById("location");


            if (!$('#location').val()) {
                var text = "empty";
                console.log(text);
            } else {
                var text = s.options[s.selectedIndex].text;
            }

            $.ajax({
                url: 'location.php',
                method: 'POST',
                data: {
                    action: action,
                    text: text
                },
                success: function(response) {
                    $("#result").html(response);
                    $("#loader").hide();
                    $("#textChange").text("Filtered Cars");
                }
            });
        }, 500);

    });
});
    </script>


    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black">OC Rentals</h1>
                            <p class="intro-text">
                                Online Car Rental Service
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-2">
                <div>
                    <br><br><br><br><br>
                    <h3>Filter</h3>
                    <hr>
                    <h6 class="text-info">Price Range</h6>
                    <div class="row">
                        &emsp;&nbsp;<label for="minimum_range">Min</label> &emsp; &emsp; &emsp; &emsp; &emsp;
                        <label for="maximum_range">Max</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" name="minimum_range" id="minimum_range" class="form-control"
                                value="<?php echo $minimum_range; ?>">
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="maximum_range" id="maximum_range" class="form-control"
                                value="<?php echo $maximum_range; ?>">
                        </div><br>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="padding-top:12px">
                            <center>
                                <div id="price_range"></div>
                            </center>
                        </div>
                    </div>
                    <!-- <div class="row">
        <div class="container" style="padding-right:20px; padding-top:10px;">
        <button class="btn btn-primary" >Filter</button>
       </div>
       </div> -->

                    <h6 class="text-info">Select Brand</h6>
                    <ul class="list-group">
                        <?php
                $sql="SELECT DISTINCT brand_name FROM cars ORDER BY brand_name";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
            ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check"
                                        value="<?= $row['brand_name']; ?>" id="brand_name"> <?= $row['brand_name']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>

                    <h6 class="text-info">Select Car Type</h6>
                    <ul class="list-group">
                        <?php
                $sql="SELECT DISTINCT vehicle_type FROM cars ORDER BY vehicle_type";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
            ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check"
                                        value="<?= $row['vehicle_type']; ?>" id="vehicle_type">
                                    <?= $row['vehicle_type']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>

                    <h6 class="text-info">Transmission</h6>
                    <ul class="list-group">
                        <?php
                $sql="SELECT DISTINCT transmission FROM cars ORDER BY transmission";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
            ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check"
                                        value="<?= $row['transmission']; ?>" id="transmission">
                                    <?= $row['transmission']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>

                    <h6 class="text-info">Fuel Type</h6>
                    <ul class="list-group">
                        <?php
                $sql="SELECT DISTINCT fuel FROM cars ORDER BY fuel";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
            ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check"
                                        value="<?= $row['fuel']; ?>" id="fuel"> <?= $row['fuel']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>


                </div>
            </div>



            <div class="col-lg-10">
                <div id="sec2" style="color: #777;padding-top:40px;">
                    <!-- id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;"> -->
                    <h3 id="textChange" style="text-align:center;">Available Cars</h3><br>

                    <div style="display: flex; justify-content: flex-end; margin-right:4rem;">
                        <?php
            $sql="SELECT DISTINCT vendor_address from vendors ORDER BY vendor_address";
            $result=$conn->query($sql);
            ?>


                        <?php
            $json = file_get_contents('slmin.json');
            $data = json_decode($json, true);
            // print_r($data);
            // echo $data['Ampara']['cities'][0];
            echo '<select style="width: 20%;" class="selectClass form-control" name="vendor_address" id="location">';
            echo '<option></option>';
            display_array_recursive($data);
            function display_array_recursive($json_rec){

                if ($json_rec){
                    foreach($json_rec as $value){
                        if(is_array($value)){
                            display_array_recursive($value);
                        }
                        else{
                            // echo $value.'<br>';
                            echo '<option>'.$value.'</option>';
                            
                        }
                    }
                }
            }
            echo "</select>";
        ?>

                        <!-- &emsp;<button id="search" class="btn btn-primary">Search</button> -->
                    </div>

                    <hr><br>
                    <div class="text-center">
                        <img src="assets/img/loader.gif" id="loader" width="400" style="display:none;">
                    </div>
                    <div class="row" id="result">
                        <?php
                $sql="SELECT * FROM cars WHERE car_availability='Yes'";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
                    $img_url = $row['car_image'];
                    $img_arr = explode (";", $img_url);
            ?>
                        <div style="padding-top:40px;" class="col-md-3 mb-2">
                            <div class="card-deck">
                                <div id="dCard" class="card"><a href="displayfeedback.php?id=<?= $row['car_id']; ?>">
                                        <img height="160px" width="250px" style="padding-left:20px; padding-top:10px;"
                                            src="<?= $img_arr[0]; ?>" class="inr" alt="img">
                                        <div class="card-img-overlay">
                                            <h6 class="text-light bg-info text-center rounded  p-1">
                                                <?= $row['brand_name']; ?> <?= $row['car_name']; ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title">Fare:Rs.<?= $row['price_per_day']; ?>/Day </h5>
                                                <p>
                                                    Transmission: <?= $row['transmission']; ?><br>
                                                    Fuel: <?= $row['fuel']; ?><br>
                                                    Mileage: <?= $row['mileage']; ?><br>

                                                    <?php $vsql = "SELECT vendor_username FROM vendorcars WHERE car_id =".$row['car_id'];
                                        $result1=$conn->query($vsql);
                                        while($row1=$result1->fetch_assoc()) {
                                            $vendor = $row1['vendor_username'];
                                        } ?>
                                                    Vendor: <?= $vendor; ?><br>
                                                </p>
                                            </center>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>





                </div>
            </div>
        </div>

        <script>
        $(document).ready(function() {

            $("#price_range").slider({
                range: true,
                min: 0,
                max: 40000,
                values: [<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>],
                slide: function(event, ui) {
                    $("#minimum_range").val(ui.values[0]);
                    $("#maximum_range").val(ui.values[1]);
                    load_product(ui.values[0], ui.values[1]);
                }
            });

            load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);

            function load_product(minimum_range, maximum_range) {
                $.ajax({
                    url: "price_filter.php",
                    method: "POST",
                    data: {
                        minimum_range: minimum_range,
                        maximum_range: maximum_range
                    },
                    success: function(data) {
                        $('#result').fadeIn('slow').html(data);
                    }
                });
            }

        });
        </script>

        <script>
        $(document).ready(function() {
            $(".product_check").click(function() {
                $("#loader").show();
                console.log("clicked");
                setTimeout(function() {
                    var action = 'data';
                    var min = $("#minimum_range").val();
                    var max = $("#maximum_range").val();
                    // alert(min);
                    var brand_name = get_filter_text('brand_name');
                    var vehicle_type = get_filter_text('vehicle_type');
                    var transmission = get_filter_text('transmission');
                    var fuel = get_filter_text('fuel');

                    $.ajax({
                        url: 'action.php',
                        method: 'POST',
                        data: {
                            action: action,
                            brand_name: brand_name,
                            vehicle_type: vehicle_type,
                            transmission: transmission,
                            fuel: fuel,
                            min: min,
                            max: max
                        },
                        success: function(response) {
                            $("#result").html(response);
                            $("#loader").hide();
                            $("#textChange").text("Filtered Cars");
                        }
                    });
                }, 500);

            });

            function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function() {
                    filterData.push($(this).val());
                });
                return filterData;
            }
        });
        </script>

        <?php include 'footer.php';?>