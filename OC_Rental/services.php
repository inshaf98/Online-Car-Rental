<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>

<?php include 'assets.php';?>
<?php include 'header.php';?>

<style>
.det_cont_box {
    background-color: #FFF;
    padding: 1%;
    max-width: 990px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    width: 100% !important;
    position: relative;
    display: block;
    height: auto;
}

.det_cont_box_ins {
    height: 100%;
    display: inline-block;
}

.services_box {
    border: solid 1px rgba(51, 51, 51, 0.1);
    margin-top: 2%;
    padding: 2%;
    min-height: 550px;
    transition: all 0.4s;
    background-color: rgba(192, 0, 0, 0);
}

.services_box:hover {
    background-color: rgba(131, 207, 237, 0.30);
}

.serv_titt {
    text-align: center;
    color: #296d98;
    text-transform: uppercase;
    min-height: 70px;
    font-weight: bolder;
}

.text-center {
    text-align: center;
}

.pro_tech_spec {
    font-size: 13px;
    text-align: left;
}

hr {
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    height: 0;
}

.faq_sec {
    padding: 2% 4%;
    margin-top: -25px;
    background-color: #CCC;
}
</style>

<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1 class="text-center">Services By OC Rentals</h1>
        <p class="text-center"> These are the services offered by OC Rental </p>
    </div>
</div>

<div class="container-fluid faq-sec">
    <div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
    <div class="det_cont_box">
        <div class="det_cont_box_ins" style="padding: 2%;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
                <h4 class="serv_titt">Self-Drive Rentals</h4>
                <h3 class="text-center"><i class="fa fa-car fa-3x ser_icon"></i></h3>
                <br>
                <hr class="box_sep_line">
                <br>
                <p class="pro_tech_spec">If you are looking for a vehicle to drive for your personal use, we have a wide
                    range of options that are classified under 4 categories for you to choose from, depending on your
                    requirement. Our flexible rental periods allow you to have the vehicle either on a weekly or monthly
                    basis.</p>
                <p class="pro_tech_spec">Renting vehicles for self- driving is much easier with us as we take extra
                    steps to minimize issues you may have with a rental service.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
                <h4 class="serv_titt">Weddings &amp; Events</h4>
                <h3 class="text-center"><i class="fa fa-glass fa-3x ser_icon"></i></h3>
                <br>
                <hr class="box_sep_line">
                <br>
                <p class="pro_tech_spec">When it is that moment when how you arrive matters, we are there to provide you
                    with a vehicle that best suits your occasion. Whether it is a wedding, corporate event, celebrity
                    event or VIP event, our vast selection of prime vehicles will contribute to make that important
                    moment, a memorable one. </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
                <h4 class="serv_titt">Airport Transfers</h4>
                <h3 class="text-center"><i class="fa fa-plane fa-3x ser_icon"></i></h3>
                <br>
                <hr class="box_sep_line">
                <br>
                <p class="pro_tech_spec">Foreign travel can be stressful and exhausting, so we will take care of your
                    hassle free drop off and pick up to and from any location in Sri Lanka, at any time of the day and
                    night, making your travel seamless and comfortable. Our friendly and decent drivers will provide
                    transport to tourists and transit passengers to any part of the island.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
            <h4 class="serv_titt">Chauffer Driven Tours</h4>
            <h3 class="text-center"><i class="fa fa-map fa-3x ser_icon"></i></h3>
            <br>
            <hr class="box_sep_line">
            <br>
            <p class="pro_tech_spec">Our vehicles and drivers can ensure that you have an unforgettable tour to any
                destination in Sri Lanka. Our drivers are polite, friendly and so experienced that they are able to
                cover any terrain in the island as well as capable of acting as guides at various tourist locations.</p>
            <p class="pro_tech_spec">The vehicles are taken good care of and kept in mint condition throughout the tour,
                no matter the distance or how many days you travel.</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
            <h4 class="serv_titt">Limousine Services</h4>
            <h3 class="text-center"><i class="fa fa-bus fa-3x ser_icon"></i></h3>
            <br>
            <hr class="box_sep_line">
            <br>
            <p class="pro_tech_spec">We offer you the luxury of the best limousine experience, no matter what the
                occasion is; wedding, corporate events, celebrity events, VIP events or birthdays. Even though driving a
                limousine is no easy task, our professional and experienced drivers can pick you up and drop you off at
                any location in Sri Lanka.</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
            <h4 class="serv_titt">Fleet Management</h4>
            <h3 class="text-center"><i class="fa fa-puzzle-piece fa-3x ser_icon"></i></h3>
            <br>
            <hr class="box_sep_line">
            <br>
            <p class="pro_tech_spec">Asia fleet provide an end-to-end suite of fleet management services and allow
                companies to eliminate or minimize the risks associated with vehicle investment and therefore, help in
                improving, efficiency, productivity and reducing their overall transportation and staff costs.From the
                point where our partnership beginsour responsive and knowledgeable team will manage the fleet so you can
                manage your business. we realize that your success is the ultimate measure of our success.</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
            <h4 class="serv_titt">Project Management / Corporate Rental Service</h4>
            <h3 class="text-center"><i class="fa fa-coffee fa-3x ser_icon"></i></h3>
            <br>
            <hr class="box_sep_line">
            <br>
            <p class="pro_tech_spec">We are capable of providing short and long term corporate vehicle requirements for
                government and private-sector small, medium and large scale projects. Our corporate rental services have
                earned us a strong reputation in the industry. We ensure that each vehicle has an appropriate insurance
                cover and is maintained and serviced at regular intervals.</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 services_box">
            <h4 class="serv_titt">Operational Leasing</h4>
            <h3 class="text-center"><i class="fa fa-wrench fa-3x ser_icon"></i></h3>
            <br>
            <hr class="box_sep_line">
            <br>
            <p class="pro_tech_spec">We offer operational leasing for clients who need consistent renewal and update of
                their vehicles, without acquiring ownership of the vehicles. You just have to pay fixed monthly payment
                and we take the responsibility of vehicle’s maintenance charges, vehicle services, licensing and all
                other expenses. With Asia Fleet, you will always have peace of mind. you simply drive the vehicle and we
                take care of everything else.</p>
        </div>
    </div>
</div>

</div>
<br><br>
<?php include 'footer.php';?>