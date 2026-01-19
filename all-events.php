<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user signin </title>

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
         <div class="wrapper single-blog">
         
           
           <div id="home" class="header-slider-area">
                
                   <?php include_once('includes/header.php');?>
                
            </div>
            <div class="breadcumb-area bg-overlay">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">All Events</li>
                    </ol>
                </div>
            </div> 
       <div class="upcomming-events-area off-white ptb100">
                  <div class="container">
                      <div class="row">
                          <div class="col-xs-12">
                           <h1 class="section-title">Events</h1>
                        </div>
                          <div class="total-upcomming-event col-md-12 col-sm-12 col-xs-12">
<?php
    $isactive = 1;
    $sql = "SELECT EventName, EventLocation, EventAmount, EventImage, id FROM tblevents WHERE IsActive = :isactive ORDER BY id DESC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

     if ($query->rowCount() > 0) {
        foreach ($results as $row) {
?>
<div class="single-upcomming shadow-box" style="padding: 10px; margin-bottom: 10px;">
   <div class="row" style="display: flex; align-items: center;">
      <div class="col-md-3 col-sm-4 col-xs-12" style="display: flex; justify-content: flex-end; padding-right: 10px;">
         <div class="sue-pic">
            <img src="admin/eventimages/<?php echo htmlentities($row->EventImage);?>" alt="<?php echo htmlentities($row->EventName);?>" style="border:1px solid #000; width:100%; height:auto; max-width:220px;">
         </div>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-12" style="display: flex; align-items: center; gap: 100px; flex-wrap: wrap;">
         <div>
            <strong>Amount: ₹<?php echo htmlentities($row->EventAmount); ?></strong>
         </div>
         <div>
            <?php echo htmlentities($row->EventName);?>
         </div>
         <div>
            Location: <?php echo htmlentities($row->EventLocation);?>
         </div>
         <div>
            <a href="event-details.php?evntid=<?php echo htmlentities($row->id);?>" 
               class="btn btn-primary" 
               style="padding: 10px 20px; font-size: 16px; border-radius: 8px;">
               View Details
            </a>
         </div>
      </div>
   </div>
</div>
 <?php } }  else { ?>                
 <p>No Record Found</p>    
 <?php } ?>                           
                             
                             <hr />
                          
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