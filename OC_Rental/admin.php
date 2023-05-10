<?php

include('login_admin.php'); // Includes Login Script

include('login_customer.php');
include('login_vendor.php');
if(isset($_SESSION['login_customer']) || isset($_SESSION['login_vendor'])){
    header("location: logout.php"); //Redirecting
    }

if(isset($_SESSION['login_admin'])){
header("location: admin_dashboard.php"); //Redirecting
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Customer Login | OC Rental </title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<style>
.form-control:focus {
    border-color: #28B62C;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(40, 182, 44, 0.6);
}
</style>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron">
        <h1 class="text-center">OC Rentals - Admin Panel </span>
        </h1>
        <br>
        <p class="text-center">Please LOGIN to continue.</p>
    </div>
</div>

<div class="container" style="margin-top: -2%; margin-bottom: 2%;">
    <div class="col-md-5 col-md-offset-4">

        <div style="padding-top:40px;">
            <?php
                    if(isset($_SESSION['status'])){
                        echo "<b><p>".$_SESSION['status']."</p></b>";
                        unset($_SESSION['status']);
                    }
                ?>
        </div>

        <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
        <div class="panel panel-success">
            <div class="panel-heading"> Login </div>
            <div class="panel-body">

                <form action="" method="POST">

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="admin_username"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Username: </label>
                            <div class="input-group">
                                <input class="form-control" id="admin_username" type="text" name="admin_username"
                                    placeholder="Username" required="" autofocus="">
                                <span class="input-group-btn">
                                    <label class="btn btn-success"><span class="glyphicon glyphicon-user"
                                            aria-hidden="true"></label>
                                </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="customer_password"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Password: </label>
                            <div class="input-group">
                                <input class="form-control" id="admin_password" type="password" name="admin_password"
                                    placeholder="Password" required="">
                                <span class="input-group-btn">
                                    <label class="btn btn-success"><span class="glyphicon glyphicon-lock"
                                            aria-hidden="true"></span></label>
                                </span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4">
                            <button class="btn btn-success" name="submit" type="submit" value=" Login ">Submit</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php';?>

</html>