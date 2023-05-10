<?php include 'assets.php';?>

<?php 
 include('session_admin.php');
if(!isset($_SESSION['login_admin'])){
    session_destroy();
    header("location: adminlogin.php");
}
?> 
<?php include 'header.php';?>
<html>
    <head>
    <style>


/* Rounded border */
hr.rounded {
  border-top: 8px solid lightblue;
  border-radius: 5px;
}

div .container1{
width:100%;
background-color:white;
border-radius:8px;
}

h4{
 padding:10Px;
 font-weight:bold;
}

h3{
	font-weight:bold;
	font-size:35px;
}

p{
	color:#222222
}

/* Card Styling */
.card{
/* box-shadow: 1px 1px 1px hsl(0, 0%, 52%); */
padding:20px;
margin-top:3%;
margin-bottom:5%;
border-radius:20px;
border:none;
color:white;
opacity: 0.9;
transition:0.4s;

background: rgba(255,255,255,0.35);
}
.card:hover {
	box-shadow: 3px 3px 8px hsl(0, 0%, 52%);
/* box-shadow: -1px 6px 3px hsl(0, 0%, 60%); */
opacity: 1;
transform: scale(1.10);
background: rgba(255,255,255,0.65);
}

.fryt{
	float:right;
}

</style>

            
<body class="fbg" background="assets/img/admin4.png" >
<div class="bg">
<div class="container-fluid" style="margin-top:8%;width:70%">
    <div class="container-fluid">
        <h1 align="center" style="font-family:Nunito, serif;">ADMIN DASHBOARD</h1><hr>
    </div>
             <div class="row">


					<div class="col-md-4" ><a href="manage_customer.php">
						    <div class="card" >
						        <h2>Customers<i class="fa fa-users fryt" style="" aria-hidden="true"></i></h2><br/>
						        <h4>Total Users</h4>
						        <p>Manage Customer's of OC Rentals</p>
							</div></a>
					</div>

				 <div class="col-md-4" ><a href="manage_vendor.php">
						    <div class="card">
						        <h2>Vendors <i class="fa fa-user fryt" aria-hidden="true"></i></h2><br/>
						        <h4>Total Vendors</h4>
						        <p>Manage Vendor's of OC Rental</p>
							</div></a>
					</div>

                    <div class="col-md-4" ><a href="manage_bookings.php">
						    <div class="card">
						        <h2>Bookings <i class="fa fa-car fryt" aria-hidden="true"></i></h2><br/>
						        <h4>Total Bookings</h4>
						        <p>View Bookings Made</p>
							</div></a>
					</div>

				 <div class="col-md-4" ><a href="my_inquiry.php">
						    <div class="card">
						        <h2>Manage Inquiry <i class="fa fa-question-circle fryt" aria-hidden="true"></i></h2><br/>
						        <h4>Total inquiries</h4>
						        <p>Manage Customer inquiries</p>
							</div></a>
					</div>

				  <div class="col-md-4" ><a href="payments.php">
						    <div class="card">
						        <h2>Payments<i class="fa fa-paypal fryt" aria-hidden="true"></i></h2><br/>
						        <h4>Total Payments Made</h4>
						        <p>View Payments made for Bookings</p>
							</div></a>
					</div>


					<div class="col-md-4" ><a href="manage_feedback.php">
					<div class="card">
								<h2>Feedbacks <i class="fa fa-comments fryt" aria-hidden="true"></i></h2><br/>
						        <h4>Total Feedbacks</h4>
						        <p>View all feedbacks by cars</p>
					</div></a>
					</div>
             </div>
		</div>
	</div>

<br><br><br><br><br>

<?php include 'footer.php';?>