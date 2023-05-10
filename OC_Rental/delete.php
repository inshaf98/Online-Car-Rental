<?php 
session_start();
include 'assets.php';
?>

<?php 
    require 'connection.php';
    $conn = Connect();

if(isset($_SESSION['login_admin'])){
   
    $username = $_GET['id'];
    $role = $_GET['user'];
    $action = "";
    

    if($role == "customer"){
        $stat = 0;
        $sql = "UPDATE customers SET verify_status=".$stat." WHERE customer_username='$username'";
        $result = $conn->query($sql);
        if ($result){
            $action = "customer";
        }

    }elseif($role == "vendor"){
        $stat = 0;
        $sql = "UPDATE vendors SET verify_status=".$stat." WHERE vendor_username='$username'";
        $result1 = $conn->query($sql);
        if ($result1){
            $action = "vendor";
        }
    }
    elseif($role == "booking"){
        $sql = "DELETE FROM rentedcars WHERE id=$username";
        $result2 = $conn->query($sql);
        if ($result2){
            $action = "booking";
        }
    }
    elseif($role == "feedback"){
        $sql = "DELETE FROM feedback WHERE ordernumber='$username'";
        $result2 = $conn->query($sql);
        if ($result2){
            $action = "feedback";
        }
    }

    if ($action == "customer"){
        echo "<script> 
        Swal.fire({
         icon: 'success',
         title: 'User Disabled',
         showConfirmButton: false,
         timer: 1500,
       }).then(function() {
         window.location = 'manage_customer.php';
     });
 
   ;</script>";
    }

    if ($action == "vendor"){
        echo "<script> 
        Swal.fire({
         icon: 'success',
         title: 'User Disabled',
         showConfirmButton: false,
         timer: 1500,
       }).then(function() {
         window.location = 'manage_vendor.php';
     });
 
   ;</script>";
    }

    if ($action == "booking"){
        echo "<script> 
        Swal.fire({
         icon: 'success',
         title: 'Booking Deleted',
         showConfirmButton: false,
         timer: 1500,
       }).then(function() {
         window.location = 'manage_bookings.php';
     });
 
   ;</script>";
    }
    if ($action == "feedback"){
        echo "<script> 
        Swal.fire({
         icon: 'success',
         title: 'Feedback Deleted',
         showConfirmButton: false,
         timer: 1500,
       }).then(function() {
         window.location = 'manage_feedback.php';
     });
 
   ;</script>";
    }
    else {
        echo $conn->error;
    }

}
else{
    session_destroy();
    header("location: index.php");
}

?>





