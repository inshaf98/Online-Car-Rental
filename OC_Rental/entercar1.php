<html>

  <head>
    <title> customer Signup | oc Rentals </title>
  </head>
  <?php session_start(); ?>
<?php include 'assets.php';?>
<?php include 'header.php';?>
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

$car_brandname = $conn->real_escape_string($_POST['car_brandname']);
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


if (!empty($_FILES["uploadedimage1"]["name"])) {
    // $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name1=$_FILES["uploadedimage1"]["tmp_name"];
    $imgtype1=$_FILES["uploadedimage1"]["type"];
    // $ext= GetImageExtension($imgtype1);
    $imagename1=$_FILES["uploadedimage1"]["name"];
    $target_path1 = "assets/img/cars/".$imagename1;
    move_uploaded_file($temp_name1, $target_path1);


    //File2
    $temp_name2=$_FILES["uploadedimage2"]["tmp_name"];
    $imgtype2=$_FILES["uploadedimage2"]["type"];
    $imagename2=$_FILES["uploadedimage2"]["name"];
    $target_path2 = "assets/img/cars/".$imagename2;
    move_uploaded_file($temp_name2, $target_path2);

    //File3
    $temp_name3=$_FILES["uploadedimage3"]["tmp_name"];
    $imgtype3=$_FILES["uploadedimage3"]["type"];
    $imagename3=$_FILES["uploadedimage3"]["name"];
    $target_path3 = "assets/img/cars/".$imagename3;
    move_uploaded_file($temp_name3, $target_path3);

    $target_path = $target_path1.";".$target_path2.";".$target_path3;

    //File 4 Optional
    if (!empty($_FILES["uploadedimage4"]["name"])) {
        $temp_name4=$_FILES["uploadedimage4"]["tmp_name"];
        $imgtype4=$_FILES["uploadedimage4"]["type"];
        $imagename4=$_FILES["uploadedimage4"]["name"];
        $target_path4 = "assets/img/cars/".$imagename4;
        move_uploaded_file($temp_name4, $target_path4);

        $target_path .=";".$target_path4;
    }

        //File 5 Optional
        if (!empty($_FILES["uploadedimage5"]["name"])) {
            $temp_name5=$_FILES["uploadedimage5"]["tmp_name"];
            $imgtype5=$_FILES["uploadedimage5"]["type"];
            $imagename5=$_FILES["uploadedimage5"]["name"];
            $target_path5 = "assets/img/cars/".$imagename5;
            move_uploaded_file($temp_name5, $target_path5);
    
            $target_path .=";".$target_path5;
        }



    // if(move_uploaded_file($temp_name, $target_path)) {
        //$query0="INSERT into cars (car_img) VALUES ('".$target_path."')";
      //  $query0 = "UPDATE cars SET car_img = '$target_path' WHERE ";
        //$success0 = $conn->query($query0);

        $query = "INSERT into cars(brand_name,car_name,car_image,price_per_day,numberplate,mileage,transmission,seats,luggage,fuel,description,car_availability,vehicle_type) 
        VALUES('" . $car_brandname . "','" . $car_name . "','".$target_path."','" . $price_per_day . "','" . $car_numberplate . "',
        '" . $car_mileage . "','" . $car_transmission . "','" . $car_seats . "','" . $car_luggage . "',
        '" . $car_fuel . "','" . $car_description . "','" . $car_availability ."','" . $vehicle_type ."')";
        $success = $conn->query($query);

        
    // } 

}


// Taking car_id from cars

$query1 = "SELECT car_id from cars where numberplate = '$car_numberplate'";

$result = mysqli_query($conn, $query1);
$rs = mysqli_fetch_array($result, MYSQLI_BOTH);
$car_id = $rs['car_id'];

$lvendor = $_SESSION['login_vendor'];

$query2 = "INSERT into vendorcars(car_id,vendor_username) values('" . $car_id ."','" . $lvendor . "')";
$success2 = $conn->query($query2);

if (!$success){ ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        Car with the same vehicle number already exists!
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
            title: 'Car Added Succesfully',
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = 'mycars.php';
        });

        ;</script>";
    // echo "<script> window.location.href='entercar.php';</script>";
}

$conn->close();

?>

    </body>
    <?php include 'footer.php';?>
</html>