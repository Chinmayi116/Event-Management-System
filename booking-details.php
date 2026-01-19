<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['usrid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    $uid = $_SESSION['usrid'];
    $bkngid = intval($_GET['bkid']);

    if (isset($_POST['cancellbooking'])) {
        $cancelremark = $_POST['cancelltionremark'];
        $status = "Cancelled";

        $sql = "UPDATE tblbookings SET UserCancelRemark=:cancelremark, BookingStatus=:status WHERE UserId=:uid AND id=:bkngid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cancelremark', $cancelremark, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':bkngid', $bkngid, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Success: Booking Cancelled.');</script>";
        echo "<script>window.location.href='my-bookings.php'</script>";
        exit();
    }


    $sql = "SELECT 
            tblbookings.BookingId, 
            tblbookings.BookingDate, 
            tblbookings.BookingStatus, 
            tblevents.EventName, 
            tblevents.id AS evtid, 
            tblbookings.UserRemark, 
            tblbookings.NumberOfMembers, 
            tblbookings.AdminRemark, 
            tblbookings.LastUpdationDate, 
            tblbookings.UserCancelRemark, 
            tblbookings.EventStartDate AS EventStartDate, 
            tblbookings.EventEndDate AS EventEndDate, 
            tblevents.EventLocation 
        FROM tblbookings 
        LEFT JOIN tblevents ON tblevents.id = tblbookings.EventId 
        WHERE tblbookings.UserId = :uid AND tblbookings.id = :bkngid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':bkngid', $bkngid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        $bstatus = $result->BookingStatus;
?>
<!doctype html>
<html lang="en">
<head>
    <title>Event Management System | Booking Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/faicons.css">
    <link href="css/color/skin-default.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<div class="wrapper single-blog">
    <?php include_once('includes/header.php'); ?>

    <div class="breadcumb-area bg-overlay">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Booking Details</li>
            </ol>
        </div>
    </div>

    <div class="single-blog-area ptb100 fix">
        <div class="container">
            <div class="row">
                <?php include_once('includes/myaccountbar.php'); ?>

                <div class="col-md-8 col-sm-7">
                    <div class="single-blog-body">
                        <div class="Leave-your-thought mt50" id="exampl">
                            <h3 class="aside-title uppercase">
                                <a href="event-details.php?evntid=<?php echo htmlentities($result->evtid); ?>">
                                    <?php echo htmlentities($result->EventName); ?>
                                </a> Booking Details
                            </h3>
                            <div class="table-responsive">
                                <table border="2" class="table">
                                    <tr>
                                        <th>Booking Number</th>
                                        <td><?php echo htmlentities($result->BookingId); ?></td>
                                        <th>Booking Date</th>
                                        <td><?php echo htmlentities($result->BookingDate); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Number of Members</th>
                                        <td><?php echo htmlentities($result->NumberOfMembers); ?></td>
                                        <th>User Remark</th>
                                        <td><?php echo htmlentities($result->UserRemark); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Event Name</th>
                                        <td><a href="event-details.php?evntid=<?php echo htmlentities($result->evtid); ?>"><?php echo htmlentities($result->EventName); ?></a></td>
                                        <th>Event Date</th>
                                        <td><?php echo htmlentities($result->EventStartDate); ?> to <?php echo htmlentities($result->EventEndDate); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Event Location</th>
                                        <td><?php echo htmlentities($result->EventLocation); ?></td>
                                        <th>Booking Status</th>
                                        <td><?php echo $bstatus ? htmlentities($bstatus) : "Not confirmed Yet"; ?></td>
                                    </tr>
                                    <?php if ($result->AdminRemark != "") { ?>
                                    <tr>
                                        <th>Admin Remark</th>
                                        <td colspan="3"><?php echo htmlentities($result->AdminRemark); ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($result->UserCancelRemark != "") { ?>
                                    <tr>
                                        <th>User Cancellation Remark</th>
                                        <td colspan="3"><?php echo htmlentities($result->UserCancelRemark); ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($result->LastUpdationDate != "") { ?>
                                    <tr>
                                        <th>Last Updation Date</th>
                                        <td colspan="3"><?php echo htmlentities($result->LastUpdationDate); ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                                                Cancel this Booking
                                            </button>
                                        </td>
                                        <td colspan="2" align="center">
                                            <i class="fa fa-print fa-2x" onclick="CallPrint()" style="cursor: pointer; color:rgb(61, 109, 161);"></i>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cancel Booking</h4>
                </div>
                <div class="modal-body">
                    <?php if (empty($bstatus)) { ?>
                        <form method="post">
                            <textarea placeholder="Cancellation Reason" class="form-control" name="cancelltionremark" required></textarea>
                            <button type="submit" class="btn btn-danger" name="cancellbooking">Submit</button>
                        </form>
                    <?php } else { ?>
                        <p>Booking cann't be cancelled.</p>
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

<script>
function CallPrint() {
    var prtContent = document.getElementById("exampl");
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>

<script src="js/vendor/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php
    } else {
        echo "<script>alert('Booking Not Found');</script>";
        echo "<script>window.location.href='my-bookings.php'</script>";
    }
}
?>
