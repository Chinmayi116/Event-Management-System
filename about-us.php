<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Event Management System | About us  </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/icofont.css">
        <link rel="stylesheet" href="css/nivo-slider.css">
        <link rel="stylesheet" href="css/animate-text.css">
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
		<link href="css/color/skin-default.css" rel="stylesheet">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>

         <div class="wrapper waraper-404">
           <div id="home" class="header-slider-area">
        <?php include_once('includes/header.php');?>

            </div>
            <div class="breadcumb-area bg-overlay">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">About us
                        </li>
                    </ol>
                </div>
            </div> 
            <div class="area-404 fix">
                <div class="container ptb50">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <img src="img/aboutus.png" alt="About us">
 <?php
 $ptype="aboutus";
$ret = "select  PageDetails from tblpages where PageType=:ptype";
$query = $dbh -> prepare($ret);
$query -> bindParam(':ptype',$ptype, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ ?>                           
<p style="margin-top:2%"><?php echo $row->PageDetails;?></p>
                    <?php }} ?>
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
