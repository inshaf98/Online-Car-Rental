<?php
session_start(); 
require 'connection.php';
$conn = Connect();


if(isset($_POST['action'])){
    $carid = $_POST['carid'];
    $rcid = $_POST['rcid'];

    $sql = "UPDATE cars SET car_availability='yes' WHERE car_id=".$carid;
    $result = $conn->query($sql);

    $sql2 = "DELETE FROM rentedcars WHERE id=".$rcid;
    $result2 = $conn->query($sql2);

}

?>