<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['usrid'])==0) {   
    header('location:logout.php');
} else {
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Event Management System | My Bookings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/icofont.css">
    <link rel="stylesheet" href="css/nivo-slider.css">
    <link rel="stylesheet" href="css/animate-text.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/faicons.css">
    <link href="css/color/skin-default.css" rel="stylesheet">   
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    
    <div class="wrapper single-blog">
        <div id="home" class="header-slider-area">
            <?php include_once('includes/header.php');?>
        </div>
        <div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">My Bookings</li>
                </ol>
            </div>
        </div> 
        <div class="single-blog-area ptb100 fix">
            <div class="container">
                <div class="row">
                    <?php include_once('includes/myaccountbar.php');?>
                    <div class="col-md-8 col-sm-7">
                        <div class="single-blog-body">
                            <div class="Leave-your-thought mt50">
                                <h3 class="aside-title uppercase">My Bookings</h3>
                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                        <div class="input-box leave-ib">
                                            <div class="table-responsive">
                                                <table border="2" class="table">
                                                    <tr>
                                                        <th>#</th>  
                                                        <th>Booking Id</th> 
                                                        <th>Event Name</th> 
                                                        <th>Booking Date</th> 
                                                        <th>Booking Status</th> 
                                                        <th>Action</th> 
                                                    </tr>
                                                    <?php

                                                    $uid = $_SESSION['usrid'];
                                                    $sql = "SELECT tblbookings.id as bid, tblbookings.BookingId, tblbookings.BookingDate, tblbookings.BookingStatus, tblevents.EventName, tblevents.id as evtid FROM tblbookings LEFT JOIN tblevents ON tblevents.id = tblbookings.EventId WHERE tblbookings.UserId = :uid";
                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>   
                                                        <td><?php echo htmlentities($row->BookingId);?></td>  
                                                        <td><a href="event-details.php?evntid=<?php echo htmlentities($row->evtid);?>"><?php echo htmlentities($row->EventName);?></a></td>  
                                                        <td><?php echo htmlentities($row->BookingDate);?></td>  
                                                        <td>
                                                            <?php 
                                                            $bstatus = $row->BookingStatus;
                                                            if($bstatus == "") {
                                                                echo htmlentities("Not confirmed Yet");
                                                            } else {
                                                                echo htmlentities($bstatus);
                                                            }
                                                            ?>
                                                        </td>  
                                                        <td>
                                                            <a href="booking-details.php?bkid=<?php echo htmlentities($row->bid); ?>" style="margin-right: 10px; text-decoration: none;">
                                                                <i class="fa fa-file" style="font-size: 18px; color:rgb(15, 15, 16);" aria-hidden="true"></i>
                                                            </a>
                                                        </td>   
                                                    </tr>
                                                    <?php $cnt++; } } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    
        <?php include_once('includes/footer.php');?>
        
    </div>   

    <script src="js/vendor/jquery-3.1.1.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script src="js/nivo-slider/nivo-active.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.nav.js"></script>
    <script src="js/animate-text.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php } ?>
