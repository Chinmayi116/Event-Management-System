<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['usrid'])==0)
    {   
header('location:logout.php');
}
else{ 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$uid=$_SESSION['usrid'];
    $sql ="SELECT UserPassword FROM tblusers WHERE Userid=:uid and UserPassword=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblusers set UserPassword=:newpassword where Userid=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Success : Your Password succesfully changed.');</script>";
echo "<script>window.location.href='change-password.php'</script>"; 
}
else {
echo "<script>alert('Success : Your current password is wrong');</script>";
echo "<script>window.location.href='change-password.php'</script>"; 
}
}

    ?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user profile </title>
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
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 
</script>
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
                        <li class="active">Change Password</li>
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
                                    <h3 class="aside-title uppercase">Change Password</h3>

                                    <div class="row">
                                        <form name="changepassword" method="post" onSubmit="return checkpass();">
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
<input type="password" name="password"  placeholder="Current Password"  class="info" required /> 
<input type="password" name="newpassword" id="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="New Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required /> 
<input type="password" name="confirmpassword" id="confirmpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required /> 
<span style="font-size:11px; color:red">Password atleast one number and one uppercase and lowercase letter, and at least 6 or more characters</span>
</div>
                                            </div>
                                       
<div class="col-xs-12">
<div class="input-box post-comment">
<input type="submit" value="Change" id="change" name="change" class="submit uppercase"> 
</div>
</div>


                                        </form>
                                    </div>

                                </div>
                           </div>
                       </div>
                     
               </div>
           </div></div>
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
