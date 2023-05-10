<html>

<head>
    <title> Vendor Signup | OC Rentals </title>
</head>

<?php
session_start();
include 'assets.php';
include 'header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {


    $('#vendor_username').keyup(function() {
        console.log("Vendor key up");
        $.post("ven_validation.php", {
            vendor_username: $('#vendor_username').val()
        }, function(response) {
            $('#userExist').show();
            setTimeout("userresult('userExist', '" + escape(response) + "')", 800);

        });
        return false;
    });

    $('.sel1').select2({
        placeholder: 'Select District',
    });

    $('.sel2').select2({
        placeholder: 'Select City',
    });

});

function userresult(id, response) {
    $('#usercheck').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
</script>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron">
        <h1 class="text-center">OC Rentals - Registration</h1>
        <br>
        <p class="text-center">Get started by creating an vendor account</p>
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

                <form role="form" action="vendor_registered_success.php" enctype="multipart/form-data" method="POST">

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="vendor_name"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Vendor Name: </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_name" type="text" name="vendor_name"
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
                            <label for="vendor_username"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Username: </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_username" type="text" name="vendor_username"
                                    placeholder="Your Username" required="">
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
                            <label for="vendor_nic"><span class="text-danger" style="margin-right: 5px;">*</span> NIC:
                            </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_nic"
                                    pattern="([0-9]{9}[x|X|v|V]|[1|2]{1}[0|9]{1}[0-9]{10})"
                                    title="Enter A Valid NIC Number" type="text" name="vendor_nic"
                                    placeholder="Your NIC" required="">
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
                            <label for="vendor_email"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Email: </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_email" type="email" name="vendor_email"
                                    placeholder="Email" required="">
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
                            <label for="vendor_phone"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Phone: </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_phone" pattern="^(?:7|0|(?:\+94))[0-9]{9}$"
                                    title="Enter a valid phone number" type="text" name="vendor_phone"
                                    placeholder="Phone" required="">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary"><span class="glyphicon glyphicon-phone-alt"
                                            aria-hidden="true"></span></label>
                                </span>

                            </div>
                        </div>
                    </div>

                    <div id="addr" class="row">
                        <div class="form-group col-xs-12">
                            <label><span class="text-danger" style="margin-right: 5px;">*</span> Location: <span
                                    class="glyphicon glyphicon-map-marker"></span></label>

                            <?php
                                $json = file_get_contents('sl_district.json');
                                $data = json_decode($json, true);
                                // print_r($data);
                                // echo $data['Ampara']['cities'][0];
                                echo '<select class="sel1 form-control" name="vendor_district" onChange="getSelect(this)">';
                                echo '<option value="" disabled selected>District</option>';
                                display_array_recursive($data);
                                function display_array_recursive($json_rec){

                                    if ($json_rec){
                                        foreach($json_rec as $value){
                                            if(is_array($value)){
                                                display_array_recursive($value);
                                            }
                                            else{
                                                // echo $value.'<br>';
                                                echo '<option>'.$value.'</option>';
                                                
                                            }
                                        }
                                    }
                                }
                                echo "</select><br>";
                            ?>

                            <script>
                            function getSelect(thisValue) {
                                var sel_val = thisValue.options[thisValue.selectedIndex].text;
                                console.log(sel_val);
                                $.ajax({
                                    type: "POST",
                                    url: "location.php",
                                    data: {
                                        sel_val: sel_val
                                    },
                                    success: function(response) {
                                        $("#locate").html(response);
                                    }
                                });
                            }
                            </script>

                            <div id="locate">
                                <select class="sel2 form-control" name="vendor_city">
                                    <option value="" disabled selected>City</option>
                                </select>
                            </div>


                            <!-- <label for="vendor_address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
                                <div class="input-group">
                                    <input class="form-control" id="vendor_address" type="text" name="vendor_city" placeholder="City" required="">
                                    <input class="form-control" id="vendor_address" type="text" name="vendor_district" placeholder="District" required="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-home" aria-hidden="true"></label>
                                    </span>
                                    </span>
                                </div> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="vendor_password"><span class="text-danger" style="margin-right: 5px;">*</span>
                                Password: </label>
                            <div class="input-group">
                                <input class="form-control" id="vendor_password"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    type="password" name="vendor_password" placeholder="Password" required="">
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
                                <input class="form-control" id="vendor_password2"
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
                            <label><span class="text-danger" style="margin-right: 5px;">*</span> Profile Picture:
                            </label>
                            <input name="profileimage" type="file" required="">
                        </div>
                    </div>
                    <br>



                    <div class="row">
                        <div class="form-group col-xs-4">
                            <button id="myBtn" class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </div>
                    <label style="margin-left: 5px;">or</label> <br>
                    <label style="margin-left: 5px;"><a href="vendorlogin.php">Have an account? Login.</a></label>

                </form>

            </div>

        </div>

    </div>
</div>
</body>
<?php include 'footer.php';?>

<script>
var check = function() {
    if (document.getElementById('vendor_password').value ==
        document.getElementById('vendor_password2').value) {
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