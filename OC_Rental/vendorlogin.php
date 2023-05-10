<?php
include('login_vendor.php'); // Includes Login Script

if(isset($_SESSION['login_vendor'])){
    header("location: index.php"); //Redirecting
}

include 'assets.php';
include 'header.php';

?>

<!DOCTYPE html>
<html>

<body>

    <div style="padding-top:80px;" class="container">
        <div class="jumbotron">
            <h1 class="text-center">OC Rentals - Vendor Panel </span>
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
                                <label for="vendor_username"><span class="text-danger"
                                        style="margin-right: 5px;">*</span> Username: </label>
                                <div class="input-group">
                                    <input class="form-control" id="vendor_username" type="text" name="vendor_username"
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
                                <label for="vendor_password"><span class="text-danger"
                                        style="margin-right: 5px;">*</span> Password: </label>
                                <div class="input-group">
                                    <input class="form-control" id="vendor_password" type="password"
                                        name="vendor_password" placeholder="Password" required="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-lock"
                                                aria-hidden="true"></span></label>
                                    </span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-4">
                                <button class="btn btn-primary" name="submit" type="submit"
                                    value=" Login ">Submit</button>

                            </div>

                        </div>
                        <label style="margin-left: 5px;">or</label> <br>
                        <label style="margin-left: 5px;"><a href="vendorsignup.php">Create a new account.</a></label>
                        <br>
                        <label style="margin-left: 5px; font-size:12px; color:#158CBA;"><a
                                href="forgot_password.php?user=vendor">Forgot Password?</a></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php';?>

</html>