<?php
session_start(); 
require 'connection.php';
$conn = Connect();

if(isset($_POST['status'])){
    $status = $_POST['status'];
    $car_id  = $_POST['carid'];
    

    if($status == 'true'){
        $sql = "UPDATE cars SET car_availability='yes' WHERE car_id=$car_id";
    }

    if($status == 'false'){
        $sql = "UPDATE cars SET car_availability='no' WHERE car_id=$car_id";
    }

    $result = $conn->query($sql);
}

?>