<html>

  <head>

  </head>
  <?php session_start(); ?>
<?php include 'assets.php';?>
<?php include 'session_vendor.php';?>
  
<?php

$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case 'assets/img/cars/bmp': return '.bmp';
        case 'assets/img/cars/gif': return '.gif';
        case 'assets/img/cars/jpeg': return '.jpg';
        case 'assets/img/cars/png': return '.png';
        default: return false;
    }
}

$carID = $_POST['car_id'];
$car_brandname = $conn->real_escape_string($_POST['car_brandname']);
$car_old_image = $conn->real_escape_string($_POST['img_url']);
$car_name = $conn->real_escape_string($_POST['car_name']);
$car_numberplate = $conn->real_escape_string($_POST['car_numberplate']);
$price_per_day = $conn->real_escape_string($_POST['price_per_day']);
$car_mileage = $conn->real_escape_string($_POST['car_mileage']);
$car_transmission = $conn->real_escape_string($_POST['car_transmission']);
$car_seats = $conn->real_escape_string($_POST['car_seat']);
$car_luggage = $conn->real_escape_string($_POST['car_luggage']);
$car_fuel = $conn->real_escape_string($_POST['car_fuel']);
$car_description = $conn->real_escape_string($_POST['car_description']);
$vehicle_type = $conn->real_escape_string($_POST['vehicle_type']);

$car_availability = "yes";

//$query = "INSERT into cars(car_name,car_nameplate,ac_price,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $car_availability ."')";
//$success = $conn->query($query);

$target_path = "";
$img_arr = explode (";", $car_old_image);

if (!empty($_FILES["uploadedimage1"]["name"])) {
    // $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name1=$_FILES["uploadedimage1"]["tmp_name"];
    $imgtype1=$_FILES["uploadedimage1"]["type"];
    // $ext= GetImageExtension($imgtype1);
    $imagename1=$_FILES["uploadedimage1"]["name"];
    $target_path .= "assets/img/cars/".$imagename1;
    move_uploaded_file($temp_name1, "assets/img/cars/".$imagename1);
}
else{
    if (array_key_exists(0, $img_arr)){
        $target_path .= $img_arr[0];
    }
}

if (!empty($_FILES["uploadedimage2"]["name"])) {
    $temp_name2=$_FILES["uploadedimage2"]["tmp_name"];
    $imgtype2=$_FILES["uploadedimage2"]["type"];
    $imagename2=$_FILES["uploadedimage2"]["name"];
    $target_path .= ";assets/img/cars/".$imagename2;
    move_uploaded_file($temp_name2, "assets/img/cars/".$imagename2);
}else{
    if (array_key_exists(1, $img_arr)){
        $target_path .= ";".$img_arr[1];
    }
}

    //File3
if (!empty($_FILES["uploadedimage3"]["name"])) {
    $temp_name3=$_FILES["uploadedimage3"]["tmp_name"];
    $imgtype3=$_FILES["uploadedimage3"]["type"];
    $imagename3=$_FILES["uploadedimage3"]["name"];
    $target_path .= ";assets/img/cars/".$imagename3;
    move_uploaded_file($temp_name3, "assets/img/cars/".$imagename3);
}else{
    if (array_key_exists(2, $img_arr)){
        $target_path .= ";".$img_arr[2];
    }
}

    // $target_path = $target_path1.";".$target_path2.";".$target_path3;

    //File 4 Optional
    if (!empty($_FILES["uploadedimage4"]["name"])) {
        $temp_name4=$_FILES["uploadedimage4"]["tmp_name"];
        $imgtype4=$_FILES["uploadedimage4"]["type"];
        $imagename4=$_FILES["uploadedimage4"]["name"];
        $target_path .= ";assets/img/cars/".$imagename4;
        move_uploaded_file($temp_name4, "assets/img/cars/".$imagename4);
    }
    else{
        if (array_key_exists(3, $img_arr)){
            $target_path .= ";".$img_arr[3];
        }
    }

        //File 5 Optional
        if (!empty($_FILES["uploadedimage5"]["name"])) {
            $temp_name5=$_FILES["uploadedimage5"]["tmp_name"];
            $imgtype5=$_FILES["uploadedimage5"]["type"];
            $imagename5=$_FILES["uploadedimage5"]["name"];
            $target_path .= ";assets/img/cars/".$imagename5;
            move_uploaded_file($temp_name5, "assets/img/cars/".$imagename5);
        }
        else{
            if (array_key_exists(4, $img_arr)){
                $target_path .= ";".$img_arr[4];
            }
        }


        $qry = "UPDATE cars SET 
        brand_name = '".$car_brandname."',
        car_name = '".$car_name."',
        car_image = '".$target_path."',
        price_per_day = ".$price_per_day.",
        numberplate = '".$car_numberplate."',
        mileage = ".$car_mileage.",
        transmission = '".$car_transmission."',
        seats = ".$car_seats.",
        luggage = ".$car_luggage.",
        fuel = '".$car_fuel."',
        description = '".$car_description."',
        vehicle_type = '".$vehicle_type."' WHERE car_id =".$carID;

        $success = $conn->query($qry);


        if (!$success){ ?>
            <div class="container">
            <div class="jumbotron" style="text-align: center;">
                Error Updating vehicle Info
                <?php echo $conn->error; ?>
                <br><br>
                <a href="entercar.php" class="btn btn-default"> Go Back </a>
        </div>
        <?php	
        }
        else {
                    echo "<script> 
                    Swal.fire({
                    icon: 'success',
                    title: 'Car Updated Succesfully',
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = 'mycars.php';
                });
        
                ;</script>";
        }

        
    // } 



$conn->close();

?>

    </body>
    <?php include 'footer.php';?>
</html>