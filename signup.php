<?php

include('includes/config.php');
error_reporting(0);

if(isset($_POST['signup'])) {

    
    $fname = $_POST['name'];
    $uname = $_POST['username'];
    $emailid = $_POST['email'];   
    $pnumber = $_POST['phonenumber']; 
    $gender = $_POST['gender']; 
    $password = md5($_POST['pass']);  
    $status = 1;


    if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $emailid)) {
        echo "<script>alert('Error: Please enter a valid Gmail address ending with @gmail.com');</script>";
    } else {
    
        $sql = "INSERT INTO tblusers(FullName,UserName,Emailid,PhoneNumber,UserGender,UserPassword,IsActive) 
                VALUES(:fname,:uname,:emailid,:pnumber,:gender,:password,:status)";

        $query = $dbh->prepare($sql);
    
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
        $query->bindParam(':pnumber', $pnumber, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
    
        $query->execute();
        
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId) {
            echo "<script>alert('Success: User signup successful. Now you can sign in');</script>";
            echo "<script>window.location.href='signin.php'</script>";    
        } else {
            echo "<script>alert('Error: Something went wrong. Please try again');</script>";    
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Event Management System | user signup</title>
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
    <script>
    function checkusernameAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'uname='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#username-availabilty-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }

    // JavaScript email format check
    function validateForm() {
        const email = document.forms["signup"]["email"].value;
        const pattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!pattern.test(email)) {
            alert("Please enter a valid Gmail address (e.g., user@gmail.com)");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
<div class="wrapper single-blog">
    <div id="home" class="header-slider-area">
        <?php include_once('includes/header.php'); ?>
    </div>

    <div class="breadcumb-area bg-overlay">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Signup</li>
            </ol>
        </div>
    </div>

    <div class="single-blog-area ptb100 fix">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="single-blog-body">
                        <div class="Leave-your-thought mt50">
                            <h3 class="aside-title uppercase">User Signup</h3>
                            <div class="row">
                                <form name="signup" method="post" onsubmit="return validateForm();">
                                    <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                        <div class="input-box leave-ib">
                                            <input type="Full Name" name="name" pattern="^[A-Za-z]+$" placeholder="Full Name" title="Only alphabetic characters allowed; no numbers, special characters, or spaces" class="info" required>
                                            <input type="text" placeholder="Username" class="info" name="username" id="username" required onBlur="checkusernameAvailability()">
                                            <span id="username-availabilty-status" style="font-size:14px;"></span> 
                                            <input type="email" placeholder="Email Id" class="info" name="email" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com" title="Enter a valid Gmail address (e.g., user@gmail.com)">
                                            <input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" title="10 numeric characters only" class="info" name="phonenumber" maxlength="10" required>
                                            <select class="info" name="gender" required>
                                                <option value="">Select Gender</option>    
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Transgender">Transgender</option>
                                            </select>
                                            <input type="password" name="pass"
 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
 placeholder="Password" 
 title="At least one number, one uppercase and one lowercase letter, and at least 6 or more characters"
 class="info" required>

                    
                                            <span style="font-size:11px; color:red">Password must include uppercase, lowercase, number and be 6+ characters</span>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="input-box post-comment">
                                            <input type="submit" value="Submit" id="signup" name="signup" class="submit uppercase"> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 mt30">
                                        <div class="input-box post-comment" style="color:blue;"> 
                                            Already Registered? <a href="signin.php"> Sign in here</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once('includes/sidebar.php'); ?>
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