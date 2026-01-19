
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
    {

$uname=$_SESSION['uname'];
$pnumber=$_SESSION['pnumber'];
$password=md5($_POST['newpassword']);
$con="update tblusers set UserPassword=:newpassword where  UserName=:uname and PhoneNumber=:pnumber";
$query = $dbh->prepare($con);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':pnumber', $pnumber, PDO::PARAM_STR);
$query-> bindParam(':newpassword', $password, PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Success : Your Password succesfully changed.');</script>";
echo "<script>window.location.href='forgot-password.php'</script>"; 
unset($_SESSION['uname']);
unset($_SESSION['pnumber']);
}

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | Forgot Password </title>
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
                        <li class="active">Forgot Password</li>
                    </ol>
                </div>
            </div> 
        
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
                       <div class="col-md-8 col-sm-7">
                           <div class="single-blog-body">


                        
                                <div class="Leave-your-thought mt50">
                                    <h3 class="aside-title uppercase">User Forgot Password (Password Recovery)</h3>
                                    <div class="row">
            <form method="post" >
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
<input type="text" placeholder="Username" class="info" name="username" required="true">

<input type="text" name="phonenumber" placeholder="Reg Phone Number"  class="info" required /> 

</div>
                                            </div>
                                       
<div class="col-xs-12 mt10">
<div class="input-box post-comment">
<input type="submit" value="Submit" name="passwordrecovery" class="submit uppercase"> 
</div>
</div>

 <div class="col-xs-12 mt30">
 <div class="input-box post-comment" style="color:blue;"> 
  Already an account <a href="signin.php" > Login here</a>
</div>
</div>
</form>
  <form name="changepassword" method="post" onSubmit="return checkpass();">
<?php

 if(isset($_POST['passwordrecovery']))
    {
$uname=$_POST['username'];
$pnumber=$_POST['phonenumber'];
$_SESSION['uname']=$uname;
$_SESSION['pnumber']=$pnumber;
$sql ="SELECT UserPassword FROM tblusers WHERE UserName=:uname and PhoneNumber=:pnumber";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':pnumber', $pnumber, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{?>

	<h3>Reset new password Here </h3>
<div class="col-xs-12 mt30">
<div class="input-box post-comment">
<input type="password" name="newpassword" id="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="New Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required /> 
</div>
</div>

<div class="col-xs-12 mt30">
<div class="input-box post-comment">
<input type="password" name="confirmpassword" id="confirmpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required />
</div>
</div>

<div class="col-xs-12 mt10">
<div class="input-box post-comment">
<input type="submit" value="Change" name="change" class="submit uppercase"> 
</div>
</div>
<?php } else {
echo "<script>alert('Error : Invalid Details');</script>";
echo "<script>window.location.href='forgot-password.php'</script>"; 
}}?>
  </form>


                                      
                                    </div>
                                </div>
                           </div>
                       </div>
                      <?php include_once('includes/sidebar.php');?>
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
