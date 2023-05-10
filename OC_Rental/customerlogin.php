<?php
include('login_customer.php'); // Includes Login Script

if(isset($_SESSION['login_customer'])){
header("location: index.php"); //Redirecting
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Customer Login | OC Rental </title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron">
        <h1 class="text-center">OC Rentals - Customer Panel </span>
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
        <div class="panel panel-primary">
            <div class="panel-heading"> Login </div>
            <div class="panel-body">

                <form action="" method="POST">

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Username: </label>
                            <div class="input-group">
                                <input class="form-control" id="customer_username" type="text" name="customer_username"
                                    placeholder="Username" required="" autofocus="">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary"><span class="glyphicon glyphicon-user"
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
                                <input class="form-control" id="customer_password" type="password"
                                    name="customer_password" placeholder="Password" required="">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary"><span class="glyphicon glyphicon-lock"
                                            aria-hidden="true"></span></label>
                                </span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4">
                            <button class="btn btn-primary" name="submit" type="submit" value=" Login ">Submit</button>

                        </div>

                    </div>
                    <label style="margin-left: 5px;">or</label> <br>
                    <label style="margin-left: 5px;"><a href="customersignup.php">Create a new account.</a></label>
                    <br>
                    <label style="margin-left: 5px; font-size:12px; color:#158CBA;"><a
                            href="forgot_password.php?user=customer">Forgot Password?</a></label>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php';?>

</html>