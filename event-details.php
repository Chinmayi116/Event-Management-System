<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/config.php');

if (isset($_POST['book'])) {
    $bookingid = mt_rand(100000000, 999999999);  
    $userid = $_SESSION['usrid']; 
    $eid = isset($_GET['evntid']) ? intval($_GET['evntid']) : 0;  
    $eventstartdate = !empty($_POST['eventstartdate']) ? $_POST['eventstartdate'] : null;  
    $eventenddate = !empty($_POST['eventenddate']) ? $_POST['eventenddate'] : null;  
    $noofmembers = $_POST['noofmembers'];  
    $usrremark = $_POST['userremark'];  

    if ($eid > 0 && $eventstartdate && $eventenddate) {
        // Server-side validation: Ensure end date is not before start date
        if (strtotime($eventenddate) < strtotime($eventstartdate)) {
            echo "<script>alert('End date cannot be earlier than start date.');</script>";
        } else {
            $sql = "INSERT INTO tblbookings (BookingId, UserId, EventId, EventStartDate, EventEndDate, NumberOfMembers, UserRemark) 
                    VALUES (:bookingid, :userid, :eid, :eventstartdate, :eventenddate, :noofmembers, :usrremark)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
            $query->bindParam(':eventstartdate', $eventstartdate, PDO::PARAM_STR);
            $query->bindParam(':eventenddate', $eventenddate, PDO::PARAM_STR);
            $query->bindParam(':noofmembers', $noofmembers, PDO::PARAM_INT);
            $query->bindParam(':usrremark', $usrremark, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                echo '<script>alert("Event booked successfully. Booking number is ' . $bookingid . '")</script>';
                echo "<script>window.location.href='my-bookings.php'</script>";
            } else {
                echo "<script>alert('Error: Something went wrong. Please try again');</script>";
            }
        }
    } else {
        echo "<script>alert('Please fill all required fields');</script>";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Event Details</title>
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

<div id="home" class="wrapper event-details">
    <?php include_once('includes/header.php');?>

    <div class="breadcumb-area bg-overlay">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Event-details</li>
            </ol>
        </div>
    </div>

    <?php
    $eid = isset($_GET['evntid']) ? intval($_GET['evntid']) : 0;
    $isactive = 1;
    $sql = "SELECT tblcategory.CategoryName, tblevents.EventName, tblevents.EventLocation, 
            tblevents.EventStartDate, tblevents.EventEndDate, tblevents.EventImage, 
            tblevents.id, tblevents.EventDescription, tblevents.PostingDate, 
            tblsponsers.sponserName, tblsponsers.sponserLogo 
            FROM tblevents 
            LEFT JOIN tblcategory ON tblcategory.id=tblevents.CategoryId 
            LEFT JOIN tblsponsers ON tblsponsers.id=tblevents.SponserId 
            WHERE tblevents.id=:eid AND tblevents.IsActive=:isactive";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $row) {
            $eventName = isset($row->EventName) ? $row->EventName : '';
            $eventDescription = isset($row->EventDescription) ? $row->EventDescription : '';
            $sponserName = isset($row->sponserName) ? $row->sponserName : '';
            $eventLocation = isset($row->EventLocation) ? $row->EventLocation : '';
    ?>

    <div class="about-area ptb100 fix" id="about-event" style="background-color: white;">
    <div class="container" style="background-color: white;">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12" style="background-color: white;">
                <div class="about-left" style="background-color: white;">
                    <div class="about-top" style="background-color: white;">
                        <h1 class="section-title" style="text-align:justify; line-height:42px; color:blue;">
                            <?php echo htmlentities($eventName); ?> Details
                        </h1>
                        <div class="total-step" style="background-color: white;">
                            <div class="descp" style="background-color: white;">
                                <p><?php echo htmlentities($eventDescription); ?></p>
                            </div>
                            <p style="margin-top:4%"><b>Posting Date:</b> <?php echo htmlentities($row->PostingDate); ?></p>
                        </div>
                    </div>
                    <hr />
                    <div class="total-step" style="background-color: white;">
                        <div class="about-step" style="background-color: white;">
                            <h5 class="sub-title"><?php echo htmlentities($sponserName); ?></h5>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12" style="background-color: white;">
                <p align="center">
                    <img src="admin/eventimages/<?php echo htmlentities($row->EventImage); ?>" width="350" style="border:solid 1px #000;">
                </p>
                <div class="about-right" style="text-align: center; padding-top: 10px; background-color: white;">
                    <ul style="list-style: none; padding: 0; margin-bottom: 10px;">
                        <li style="font-size: 18px;">
                            <i class="zmdi zmdi-pin"></i> <?php echo htmlentities($eventLocation); ?>
                        </li>
                    </ul>
                    <div class="about-btn" style="margin-top: 10px;">
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php }} else { ?>
        <h3 align="center" style="color:red; margin-top: 4%">No record found</h3>
    <?php } ?>

    
    <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book event</h4>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['usrid']) && strlen($_SESSION['usrid']) > 0) { ?>
                        <form name="bookevent" method="post">
                            <p>
    <input type="date" name="eventstartdate" min="<?php echo date('Y-m-d'); ?>" 
required style="width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; background-color: #f9f9f9;">
    </p>
    <p>
<input type="date" name="eventenddate" min="<?php echo date('Y-m-d'); ?>" required
 style="width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; background-color: #f9f9f9;">
    </p>
    <p>
        <input type="number" placeholder="Number of Members" class="info" name="noofmembers" min="1" required style="width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; background-color: #f9f9f9;">
    </p>
    <p>
        <textarea placeholder="Discription About Event" class="info" name="userremark" required style="width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; background-color: #f9f9f9; resize: vertical; height: 100px;"></textarea>
    </p>
    <p>
        <button type="submit" class="btn btn-info btn-lg" name="book" style="background-color: #5b9bd5; color: white; padding: 14px 20px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; width: 100%; margin-top: 15px;">Submit</button>
    </p>
</form>
             <?php } else { ?>
                    <p style="color: red; text-align: center; font-weight: bold;">
                        Please <a href="http://localhost/Event-Management-System-Project-1-osbxml%20123/Event-Management-System-Project-1-osbxml/Event%20Management%20System%20Project/ems/signup.php">Sign Up</a> or <a href="http://localhost/Event-Management-System-Project-1-osbxml%20123/Event-Management-System-Project-1-osbxml/Event%20Management%20System%20Project/ems/signin.php">Login</a> to book this event.
                    </p>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/animate-text.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
