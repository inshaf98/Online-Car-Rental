<html>

<head>
    <title> Forgot Password </title>
</head>
<?php include 'assets.php';?>
<?php include 'header.php';?>
<?php $user = $_GET['user'] ?>
<div style="padding-top:80px;" class="container">
    <div class="jumbotron" style="height:14rem;">
        <h1 class="text-center">OC Rentals - Forgot Password </span>
        </h1>
        <br>
        <p class="text-center">Enter the Email or Username to Get a password Reset Mail.</p>
    </div>
</div>
<center>
    <form action="forgot_pass_process.php" method="POST">

        <h4>Enter the Email or Username</h4><br>
        <input type="hidden" name="user" value="<?php echo $user ?>">
        <input style="width:25rem;" type="text" name="uname_email"><br><br>
        <input type="submit" class="btn btn-primary" value="Submit">

    </form>
</center>