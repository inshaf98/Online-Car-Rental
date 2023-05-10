<?php
session_start(); 
require 'connection.php';
$conn = Connect();

$sql = "SELECT * FROM cars WHERE car_availability='yes' AND price_per_day BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY price_per_day ASC";
$result = $conn->query($sql);
$output = '';

if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $img_url = $row['car_image'];
        $img_arr = explode (";", $img_url);
        $output .='<div style="padding-top:40px;" class="col-md-3 mb-2">
        <div class="card-deck">
            <div id="dCard" class="card"><a href="displayfeedback.php?id='.$row['car_id'].'">
                <img height="160px" width="250px" style="padding-left:20px; padding-top:10px;" src="'.$img_arr[0].'" class="inr" alt="img">
                <div class="card-img-overlay">
                    <h6 class="text-light bg-info text-center rounded  p-1">'.$row['brand_name'].' '.$row['car_name'].'</h6>
                </div>
                <div class="card-body">
                   <center> <h5 class="card-title">Fare: Rs.'.$row['price_per_day'].'/Day </h5>
                    <p>
                        Transmission: '.$row['transmission'].'<br>
                        Fuel: '.$row['fuel'].'<br>
                        Mileage: '.$row['mileage'].'<br>
                    </p></center>
                </div>
            </div>
        </div>
    </div>';
    }
}
else{
    $output="<center><h3>No Cars Found</h3></center>";
}
echo $output;
?>
