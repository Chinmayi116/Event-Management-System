<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_POST['subscribe'])) {
    $emailid = $_POST['email'];

    $sqlcheck = "SELECT UserEmail FROM tblsubscriber WHERE UserEmail = :emailid";
    $querycheck = $dbh->prepare($sqlcheck);
    $querycheck->bindParam(':emailid', $emailid, PDO::PARAM_STR);
    $querycheck->execute();

    if ($querycheck->rowCount() > 0) {
        echo "<script>alert('This Email ID is already subscribed. You cannot subscribe again.');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        $sql = "INSERT INTO tblsubscriber(UserEmail) VALUES(:emailid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
        $query->execute();

        if ($dbh->lastInsertId()) {
            echo "<script>alert('Successfully Subscribed!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Event Management System | Home Page</title>
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
    <link rel="stylesheet" href="css/color/skin-default.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <div class="wrapper home-02">
        <?php include_once('includes/header.php'); ?>

        <div class="slider-container slider-02 bg-overlay">
            <div id="mainSlider" class="nivoSlider slider-image"> 
                <img src="img/ems1.webp" alt="event-management-system" title="#htmlcaption1" />
                <img src="img/ems.png" alt="event-management-system" title="#htmlcaption1" />
            </div>
            <div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
                <div class="container">
                    <div class="slide1-text">
                        <div class="middle-text slide-def">
                            <div class="cap-dec wow fadeInDown" data-wow-duration=".9s" data-wow-delay="0.2s" style="margin-top:-100px">
                                <h1 align="center">Event Management System</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="down-arrow">
                <a class="see-demo-btn" href="#about-event"><i class="zmdi zmdi-long-arrow-down"></i></a>
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
                                        <img src="admin/eventimages/<?php echo htmlentities($row->EventImage); ?>" alt="<?php echo htmlentities($row->EventName); ?>" style="border:1px solid #000; width:100%; height:auto; max-width:220px;">
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-8 col-xs-12" style="display: flex; align-items: center; gap: 100px; flex-wrap: wrap;">
                                    <div><strong>Amount: ₹<?php echo htmlentities($row->EventAmount); ?></strong></div>
                                    <div><?php echo htmlentities($row->EventName); ?></div>
                                    <div>Location: <?php echo htmlentities($row->EventLocation); ?></div>
                                    <div>
                                        <a href="event-details.php?evntid=<?php echo htmlentities($row->id); ?>" 
                                           class="btn btn-primary" 
                                           style="padding: 10px 20px; font-size: 16px; border-radius: 8px;">
                                           View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="call-to-action bg-overlay white-overlay pb100 pt85">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cal-to-wrap">
                            <h1 class="section-title">Enter Your Email Address For Events</h1>
                            <form method="post" name="subscribe">
                                <div class="input-box">
                                    <input type="email" placeholder="Enter your E-mail Address" class="info" name="email" required>
                                    <button type="submit" name="subscribe" class="send-btn"><i class="zmdi zmdi-mail-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>

    <script src="js/vendor/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script src="js/nivo-slider/nivo-active.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/video.js"></script>
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.nav.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script>
    <script src="js/google-map.js"></script>
    <script src="js/animate-text.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
