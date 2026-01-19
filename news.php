<?php
session_start();
include('includes/config.php');

$show_feedback_form = true;
$error_msg = '';

if (isset($_POST['verify'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    
    echo "Username: " . htmlspecialchars($username) . "<br>Email: " . htmlspecialchars($email);

    $sql = "SELECT Userid FROM tblusers WHERE BINARY UserName=:username AND BINARY UserEmail=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
    
        $sqlCheck = "SELECT id FROM tblfeedback WHERE BINARY Name = :username AND BINARY Email = :email";
        $queryCheck = $dbh->prepare($sqlCheck);
        $queryCheck->bindParam(':username', $username, PDO::PARAM_STR);
        $queryCheck->bindParam(':email', $email, PDO::PARAM_STR);
        $queryCheck->execute();

        if ($queryCheck->rowCount() > 0) {
            $error_msg = "You have already submitted feedback.";
            $show_feedback_form = false;
        } else {
            $_SESSION['verified_user'] = ['username' => $username, 'email' => $email];
            $show_feedback_form = true;
        }
    } else {
        $error_msg = "Username and Email do not match our records.";
        $show_feedback_form = true;
    }
} elseif (isset($_POST['submit_feedback'])) {
    
    if (!isset($_SESSION['verified_user'])) {
        $error_msg = "Please verify your username and email first.";
        $show_feedback_form = true;
    } else {
        $name = $_SESSION['verified_user']['username'];
        $email = $_SESSION['verified_user']['email'];
        $message = trim($_POST['message']);

        try {
            
            $sqlCheck = "SELECT id FROM tblfeedback WHERE BINARY Name = :name AND BINARY Email = :email";
            $queryCheck = $dbh->prepare($sqlCheck);
            $queryCheck->bindParam(':name', $name, PDO::PARAM_STR);
            $queryCheck->bindParam(':email', $email, PDO::PARAM_STR);
            $queryCheck->execute();

            if ($queryCheck->rowCount() > 0) {
                $error_msg = "Feedback already submitted from this username and email.";
                $show_feedback_form = false;
            } else {
        
                $sqlInsert = "INSERT INTO tblfeedback (Name, Email, Message) VALUES (:name, :email, :message)";
                $queryInsert = $dbh->prepare($sqlInsert);
                $queryInsert->bindParam(':name', $name, PDO::PARAM_STR);
                $queryInsert->bindParam(':email', $email, PDO::PARAM_STR);
                $queryInsert->bindParam(':message', $message, PDO::PARAM_STR);
                $queryInsert->execute();

                echo "<script>alert('Thank you for your feedback!');</script>";
                unset($_SESSION['verified_user']);  
                $show_feedback_form = false;
            }
        } catch (PDOException $e) {
            $error_msg = "Database error: " . $e->getMessage();
            $show_feedback_form = true;
        }
    }
}
?>


<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user signin </title>
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- icofont css -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Nivo css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- animaton text css -->
        <link rel="stylesheet" href="css/animate-text.css">
		<!-- Metrial iconic fonts css -->
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- color css -->
		<link href="css/color/skin-default.css" rel="stylesheet">
        
		<!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--body-wraper-are-start-->
         <div class="wrapper single-blog">
         
           <!--slider header area are start-->
           <div id="home" class="header-slider-area">
                <!--header start-->
                   <?php include_once('includes/header.php');?>
                <!-- header End-->
            </div>
           <!--slider header area are end-->
            
            <!--  breadcumb-area start-->
            <div class="breadcumb-area bg-overlay">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Feedback</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
<div class="single-blog-area ptb100 fix">
   <div class="container">
       <div class="row">
           <div class="col-md-12 col-sm-7">
               <div class="single-blog-body">

                    <div class="Leave-your-thought mt50">
                        <h3 class="aside-title uppercase">Give Your Feedback</h3>
                        <div class="row">
                            <form method="post" action="submit-feedback.php">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <input type="text" name="name" class="form-control" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Your Email</label>
                                        <input type="email" name="email" class="form-control" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Your Feedback</label>
                                        <textarea name="message" class="form-control" rows="5" required></textarea>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- main blog area end-->

            <!--information area are start-->
                 <?php include_once('includes/footer.php');?>
            <!--footer area are start-->
         </div>   
        <!--body-wraper-are-end-->
		
		<!--==== all js here====-->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-3.1.1.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- Nivo js -->
        <script src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
        <script src="js/nivo-slider/nivo-active.js"></script>
		<!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- Youtube Background JS -->
        <script src="js/jquery.mb.YTPlayer.min.js"></script>
		<!-- datepicker js -->
        <script src="js/bootstrap-datepicker.js"></script>
		<!-- waypoint js -->
        <script src="js/waypoints.min.js"></script>
		<!-- onepage nav js -->
        <script src="js/jquery.nav.js"></script>
        <!-- animate text JS -->
        <script src="js/animate-text.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
        <!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
