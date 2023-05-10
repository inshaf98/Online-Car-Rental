<?php
session_start(); 
require 'connection.php';
$conn = Connect();


$min = $_POST['min'];
$max = $_POST['max'];

if(isset($_POST['action'])){
    $sql = "SELECT * FROM cars WHERE price_per_day BETWEEN ".$min." AND ".$max." AND car_availability='yes' AND brand_name !=''";

    if(isset($_POST['brand_name'])){
        $brand_name = implode("','", $_POST['brand_name']);
        $sql .="AND brand_name IN('".$brand_name."')";
    }
    if(isset($_POST['vehicle_type'])){
        $vehicle_type = implode("','", $_POST['vehicle_type']);
        $sql .="AND vehicle_type IN('".$vehicle_type."')";
    }
    if(isset($_POST['transmission'])){
        $transmission = implode("','", $_POST['transmission']);
        $sql .="AND transmission IN('".$transmission."')";
    }
    if(isset($_POST['fuel'])){
        $fuel = implode("','", $_POST['fuel']);
        $sql .="AND fuel IN('".$fuel."')";
    }
    $sql .=" ORDER BY price_per_day ASC";
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
}
?>