    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    OC Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_vendor'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="profile_vendor.php"><span class="glyphicon glyphicon-user"></span> Welcome
                            <?php echo $_SESSION['login_vendor']; ?></a>
                    </li>
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><span
                                        class="glyphicon glyphicon-user"></span> Control Panel <span
                                        class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="entercar.php">Add Car</a></li>
                                    <li> <a href="mycars.php">My cars</a></li>
                                    <li> <a href="vendorview.php">View Bookings</a></li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="index.php">About</a>
                    </li>
                    <li>
                        <a href="services.php">Services</a>
                    </li>

                    <li>
                        <a href="profile_customer.php"><span class="glyphicon glyphicon-user"></span> Welcome
                            <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
                        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                                <li> <a href="mybookings.php">My Bookings</a></li>
                                <li> <a href="orderhistory.php"> Order History</a></li>
                                <li> <a href="prereturncar.php">Return Car</a></li>
                            </ul>
                        </li>

                        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"> Inquiry <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                                <li> <a href="inquiry.php">Inquire</a></li>
                                <li> <a href="my_inquiry.php"> My inquiries</a></li>
                            </ul>
                        </li>
                    </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }  elseif(isset($_SESSION['login_admin'])){ ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="admin_dashboard.php">Dashboard</a>
                    </li>

                    <li>
                        <a href="manage_vendor.php">Vendor</a>
                    </li>

                    <li>
                        <a href="manage_customer.php">Customer</a>
                    </li>

                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            <?php }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="services.php">Services</a>
                    </li>
                    <li>
                        <a href="vendorlogin.php">Vendor</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="faq/index.php"> FAQ </a>
                    </li>


                </ul>
            </div>
            <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>