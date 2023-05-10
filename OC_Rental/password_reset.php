<html>

<head>
    <title> Reset Password </title>
</head>
<div style="padding-top:80px;" class="container">
            <div class="jumbotron">
            <h1 class="text-center">OC Rentals - Password Reset </span>
                </h1>
                <br>
                <p class="text-center">Enter a New Password for Your Account</p>
            </div>
        </div>

<?php
require 'connection.php';
$conn = Connect(); 
include 'assets.php';?>
<?php include 'header.php';?>


<?php
    $token = $_GET['token'];
    $role = $_GET['role'];
    $user = $_GET['user'];


    $content = '<div class="container" style=" padding-top:40px; margin-top: -2%; margin-bottom: 2%;">
    <div class="col-md-5 col-md-offset-4">

        <div class="panel panel-primary">
            <div class="panel-heading"> Reset Password </div>
            <div class="panel-body">

                <form action="password_reset_update.php" method="POST">
                <input type="hidden" name="role" value="'.$role.'">
                <input type="hidden" name="user" value="'.$user.'">
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> New Password: </label>
                            <div class="input-group">
                                <input class="form-control" id="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" placeholder="Password" required="" autofocus="">
                                <span class="input-group-btn">
        <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="confirm_password"><span class="text-danger" style="margin-right: 5px;">*</span>Confirm Password: </label>
                            <div class="input-group">
                                <input class="form-control" id="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" name="confirm_password" placeholder="Confirm password" onkeyup="check();" required="">
                                <span class="input-group-btn">
                                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
                                </span>

                            </div>
                            <span id="message"></span>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4">
                            <button class="btn btn-primary" id="myBtn" name="submit" type="submit" value="">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';




    if($role == 'customer'){
        $user_check_query = "SELECT verify_token FROM customers WHERE customer_username = '$user' LIMIT 1";
        $user_check_run = $conn->query($user_check_query);
        if(mysqli_num_rows($user_check_run) > 0){
            while($row = mysqli_fetch_assoc($user_check_run)) {
                $tokendb = $row['verify_token'];
            }

            if($token == $tokendb){
                echo $content;
            }
            else{
                    echo "<script> 
                Swal.fire({
                icon: 'error',
                title: 'Invalid Token',
                showConfirmButton: false,
                timer: 2500,
            }).then(function() {
                window.location = 'index.php';
            });
        
        ;</script>";
            }
        }
        else{
            echo "<script> 
            Swal.fire({
             icon: 'error',
             title: 'No Users Found',
             showConfirmButton: false,
             timer: 2500,
           }).then(function() {
             window.location = 'index.php';
         });
     
       ;</script>";
        }

    }
    elseif($role == 'vendor'){
        $user_check_query = "SELECT verify_token FROM vendors WHERE vendor_username = '$user' LIMIT 1";
        $user_check_run = $conn->query($user_check_query);
        if(mysqli_num_rows($user_check_run) > 0){
            while($row = mysqli_fetch_assoc($user_check_run)) {
                $tokendb = $row['verify_token'];
            }

            if($token == $tokendb){
                echo $content;
            }
            else{
                    echo "<script> 
                Swal.fire({
                icon: 'error',
                title: 'Invalid Token',
                showConfirmButton: false,
                timer: 2500,
            }).then(function() {
                window.location = 'index.php';
            });
        
        ;</script>";
            }
        }
        else{
            echo "<script> 
            Swal.fire({
             icon: 'error',
             title: 'No Users Found',
             showConfirmButton: false,
             timer: 2500,
           }).then(function() {
             window.location = 'index.php';
         });
     
       ;</script>";
        }

    }
    else{
        echo "<script> 
        Swal.fire({
        icon: 'error',
        title: 'Invalid Token',
        showConfirmButton: false,
        timer: 2500,
    }).then(function() {
        window.location = 'index.php';
    });

;</script>";
    }


?>

       
    </body>
    <script>
    
    var check = function() {
  if (document.getElementById("password").value ==
    document.getElementById("confirm_password").value) {
    document.getElementById("message").style.color = 'green';
    document.getElementById("message").innerHTML = 'Password Match';
    document.getElementById("myBtn").disabled = false;
  } else {
    document.getElementById("message").style.color = 'red';
    document.getElementById("message").innerHTML = 'Password not Match';
    document.getElementById("myBtn").disabled = true;
  }
}

</script>
    <?php include 'footer.php';?>

    </html>