<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>
<title>Profile</title>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<style>
.rounded-border {
    /* border: 1px solid #ccc; */
    border-radius: 50%;
    height: 200px;
    width: 200px;
    max-height: 200px;
    max-width: 200px;
    min-height: 200px;
    min-width: 200px;

}

.rnd {
    width: 200px;
    clip-path: circle();
}

@keyframes fade-in {
    from {
        /* opacity: 0; */
        transform: scale(0.5);
    }

    to {
        /* opacity: 1; */
        transform: scale(1.00);
    }
}

.fade-in {
    animation: fade-in 0.8s ease-out;
}
</style>

<div class="container" style="margin-top: 65px; padding-top:4rem;">
    <div class="col-md-7" style="float: none; margin: 0 auto;">

        <div class="form-area" style="border-radius: 15px;">

            <?php $customer = $_SESSION['login_customer']; 
            $sql1 = "SELECT * FROM customers WHERE customer_username = '$customer'";
            $result1 = mysqli_query($conn, $sql1);
    
            if(mysqli_num_rows($result1)){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $customer_name = $row1["customer_name"];
                    $customer_nic = $row1["customer_nic"];
                    $customer_phone = $row1["customer_phone"];
                    $customer_email = $row1["customer_email"];
                    $customer_address = $row1["customer_address"];
                    $profile_image = $row1["profile_image"];
                }
            }
      ?>


            <center>
                <h2><b><?php echo($customer_name);?>'s Profile</b></h2><br><br>

                <div class="rounded-border">
                    <img src="<?php echo($profile_image); ?>" alt="your image description" class="img-fluid rnd fade-in"
                        style="height: 200px; width: 200px;">
                </div><br><br>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Full Name :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer_name);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Username :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Email Address :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer_email);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>NIC No. :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer_nic);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Address :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer_address);?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Phone :</strong>
                    </div>
                    <div class="col-md-4">
                        <?php echo($customer_phone);?>
                    </div>
                </div>
                <hr>





            </center>


        </div>
    </div>
</div>


</html>