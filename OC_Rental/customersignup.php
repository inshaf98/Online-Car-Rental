<html>

<head>
    <?php 
session_start();
include 'assets.php';
include 'header.php';

?>

    <script>
    $(document).ready(function() {

        $('#customer_username').keyup(function() {
            console.log("hello");
            $.post("reg_validation.php", {
                customer_username: $('#customer_username').val()
            }, function(response) {
                $('#userExist').show();
                setTimeout("userresult('userExist', '" + escape(response) + "')", 800);

            });
            return false;
        });
    });

    function userresult(id, response) {
        $('#usercheck').hide();
        $('#' + id).html(unescape(response));
        $('#' + id).fadeIn();
    }
    </script>

    <div style="padding-top:5rem">
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">OC Rentals - Registration</h1>
                <br>
                <p class="text-center">Get started by creating customer account</p>
            </div>
        </div>

        <div class="container" style="margin-top: -1%; margin-bottom: 2%;">
            <div class="col-md-5 col-md-offset-4">
                <div class="alert" style="padding-top:40px;">
                    <?php
                    if(isset($_SESSION['status'])){
                        echo "<p style='color:red;'>".$_SESSION['status']."</p>";
                        unset($_SESSION['status']);
                    }
                ?>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading"> Create Account </div>
                    <div class="panel-body">

                        <form id="Formid" role="form" action="customer_registered_success.php"
                            enctype="multipart/form-data" method="POST">

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_name"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Full Name: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_name" type="text" name="customer_name"
                                            placeholder="Your Full Name" required="" autofocus="">
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
                                    <label for="customer_username"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Username: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_username" type="text"
                                            name="customer_username" placeholder="Your Username" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-user"
                                                    aria-hidden="true"></label></span>
                                        </span>
                                    </div>
                                    <span id="usercheck"></span>
                                    <span id="userExist"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_email"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> NIC: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_nic"
                                            pattern="([0-9]{9}[x|X|v|V]|[1|2]{1}[0|9]{1}[0-9]{10})"
                                            title="Enter A Valid NIC Number (Ex:- 982553296V, 199814402717)"
                                            name="customer_nic" placeholder="Your NIC Number" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-credit-card"
                                                    aria-hidden="true"></label>
                                        </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_email"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Email: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_email" type="email"
                                            name="customer_email" placeholder="Email" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-envelope"
                                                    aria-hidden="true"></label>
                                        </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_phone"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Phone: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_phone"
                                            pattern="^(?:7|0|(?:\+94))[0-9]{9}$"
                                            title="Enter a valid phone number, (Ex:-0775594682)" type="text"
                                            name="customer_phone" placeholder="Phone" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-phone"
                                                    aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_address"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Address: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_address" type="text"
                                            name="customer_address" placeholder="Address" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-home"
                                                    aria-hidden="true"></label>
                                        </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_password"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Password: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            type="password" name="customer_password" placeholder="Password" required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-lock"
                                                    aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_password2"><span class="text-danger"
                                            style="margin-right: 5px;">*</span> Confirm Password: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_password2"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            type="password" name="customer_password2" placeholder="Confirm Password"
                                            onkeyup='check();' required="">
                                        <span class="input-group-btn">
                                            <label class="btn btn-primary"><span class="glyphicon glyphicon-lock"
                                                    aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                    <span id='message'></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label><span class="text-danger" style="margin-right: 5px;">*</span> Profile
                                        Picture: </label>
                                    <input name="profileimage" type="file" required="">
                                </div>
                            </div>
                            <br>


                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <center> <button style="width:10rem;" id="myBtn" class="btn btn-primary"
                                            type="submit">Submit</button></center>
                                </div>

                            </div>
                            <label style="margin-left: 5px;">or</label> <br>
                            <label style="margin-left: 5px;"><a href="customerlogin.php">Have an account?
                                    Login.</a></label>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php include 'footer.php';?>

    <script>
    var check = function() {
        if (document.getElementById('customer_password').value ==
            document.getElementById('customer_password2').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Password Match';
            document.getElementById("myBtn").disabled = false;
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Password not Match';
            document.getElementById("myBtn").disabled = true;
        }
    }
    </script>

</html>