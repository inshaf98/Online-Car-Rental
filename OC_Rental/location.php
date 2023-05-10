<?php
session_start(); 
require 'connection.php';
$conn = Connect();


if(isset($_POST['action'])){
    $search = $_POST['text'];


    // if ((empty($search)) OR ($search=="") OR (strlen($search) == 0)){
    if ($search=="empty"){
        // echo "<script> alert('Empty') </script>";
        $sql = "SELECT * FROM cars WHERE car_availability='yes'";
    }else{

        $sql = "SELECT vc.car_id, c.car_name, c.brand_name, c.car_image, c.price_per_day, c.mileage, c.transmission, c.fuel, vc.vendor_username, v.vendor_address 
        FROM vendors v INNER JOIN vendorcars vc ON v.vendor_username = vc.vendor_username INNER JOIN cars c ON vc.car_id = c.car_id WHERE v.vendor_address LIKE '%".$search."%' AND c.car_availability='yes'";
    }



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

elseif(isset($_POST['sel_val'])){
//    echo "<script> alert('Gotcha') </script>";
   $selVal = $_POST["sel_val"];
   $json = file_get_contents('slmin.json');
   $data2 = json_decode($json, true);
   $i=0;
   $out = "<script>$(document).ready(function(){
    $('.sel2').select2({
        placeholder: 'Select City',
    });
   });</script>
   <select class='sel2 form-control' name='vendor_city'>";

   foreach($data2[$selVal]['cities'] as $item){
    $out .= '<option>'.$data2[$selVal]["cities"][$i].'</option>';
    $i++;
   }
   $out .='</select>';
   echo $out;

}

?>



