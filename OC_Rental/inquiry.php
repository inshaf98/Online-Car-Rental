<?php
session_start();
include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}

include 'assets.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title> Inquiry | OC Rental </title>
</head>
<style>
#frm {
    /* border: none; */
    background: rgba(240, 240, 240, 0.60);
    /* background: rgba(3,138,255,0.06); */
    /* background-color:red; */
}
</style>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron" style="height:10rem;">
        <h1 class="text-center" style="margin-top:-2rem;">OC Rentals - Customer Inquiry </span>
        </h1>
        <p class="text-center">Tell what you want to know about OC Rental.</p>
    </div>
</div>


<div class="container" style="margin-top: 1%; margin-bottom: 2%;">
    <!-- <div class="col-md-5 col-md-offset-4"> -->
    <div class="col-md-7" style="float: none; margin: 0 auto;">
        <div class="form-area" id="frm" style="border-radius: 15px;">
            <form role="form" action="inquiry_process.php" method="POST">
                <label>Username</label>
                <input type="text" id="uname" name="unameDis" class="form-control" value="<?php echo $login_session; ?>"
                    disabled><br>
                <input type="hidden" name="uname" value="<?php echo $login_session; ?>">

                <label>Message</label>
                <textarea class="form-control" name="query" id="query" cols="30" rows="8" required></textarea><br>

                <input type="submit" name="send" value="Submit" class="btn btn-success pull-left">

            </form>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

</html>