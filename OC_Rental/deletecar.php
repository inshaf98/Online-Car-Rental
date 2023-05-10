<?php 
    include('session_vendor.php'); 
    include 'assets.php';

?> 
<?php



if(!isset($_SESSION['login_vendor'])){
        session_destroy();
        echo "<script> 
        Swal.fire({
        icon: 'error',
        title: 'Login as Vendor',
        showConfirmButton: false,
        timer: 2000,
    }).then(function() {
        window.location = 'vendorlogin.php';
    });

    ;</script>";
    
}
else{
    $idd = $_GET["id"];
    $id = base64_decode($idd);

    $car_check_query = "SELECT * FROM cars WHERE car_id = '$id'";
    $car_check_run = mysqli_query($conn, $car_check_query);
    if(mysqli_num_rows($car_check_run)>0){

        $sql="DELETE FROM cars WHERE car_id='$id'";
        $result = mysqli_query($conn, $sql);
    
            echo "<script> 
            Swal.fire({
             icon: 'success',
             title: 'Car Deleted',
             showConfirmButton: false,
             timer: 2000,
           }).then(function() {
             window.location = 'entercar.php';
         });
     
       ;</script>";
        
    }
    else{
        echo "<script> 
            Swal.fire({
             icon: 'error',
             title: 'No Cars Found',
             showConfirmButton: false,
             timer: 2000,
           }).then(function() {
             window.location = 'entercar.php';
         });
     
       ;</script>";
    }
       
}

?>
