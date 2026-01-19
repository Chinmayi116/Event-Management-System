<?php
session_start();

include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['usrid'])==0)
    {   
header('location:logout.php');
}
else{
if(isset($_POST['update']))
{


$uid=$_SESSION['usrid'];

$fname=$_POST['name'];
$emailid=$_POST['email'];   
$pnumber=$_POST['phonenumber']; 
$gender=$_POST['gender']; 
$sql="update  tblusers set FullName=:fname,Emailid=:emailid,PhoneNumber=:pnumber,UserGender=:gender where Userid=:uid ";

$query = $dbh->prepare($sql);

$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

echo "<script>alert('Success : Profile updated Successfully.');</script>";
echo "<script>window.location.href='profile.php'</script>";	

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
                        <li class="active">My Profile</li>
                    </ol>
                </div>
            </div> 
        
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
<?php include_once('includes/myaccountbar.php');?>
                       <div class="col-md-8 col-sm-7">
                           <div class="single-blog-body">

<?php 
$uid=$_SESSION['usrid'];
$sql = "SELECT * from  tblusers where Userid=:uid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':uid',$uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{    ?> 
                        
                                <div class="Leave-your-thought mt50">
                                    <h3 class="aside-title uppercase"><?php echo htmlentities($result->FullName);?>'s Profile</h3>
<h5>Reg. Date: <?php echo htmlentities($result->RegDate);?> </h5>
<?php if($result->LastUpdationDate!=""){?>
<h5>Last Updation Date: <?php echo htmlentities($result->LastUpdationDate);?> </h5>
<?php } ?>

                                    <div class="row">
                                        <form name="signup" method="post">
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
<input type="text" placeholder="Name" class="info" name="name" value="<?php echo htmlentities($result->FullName);?>" required="true">
<input type="text" placeholder="Username" class="info" name="username" id="username" value="<?php echo htmlentities($result->UserName);?>" readonly="true" >
<input type="email" placeholder="Email Id" class="info" name="email" required="true" value="<?php echo htmlentities($result->Emailid);?>">
<input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" title="10 numeric characters only" class="info" name="phonenumber" maxlength="10" required="true" value="<?php echo htmlentities($result->PhoneNumber);?>">
<select class="info" name="gender" required="true">
<option value="<?php echo htmlentities($result->UserGender);?>"><?php echo htmlentities($result->UserGender);?></option>	
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Transgender">Transgender</option>
</select>
</div>
                                            </div>
                                       
<div class="col-xs-12">
<div class="input-box post-comment">
<input type="submit" value="Update" id="update" name="update" class="submit uppercase"> 
</div>
</div>


                                        </form>
                                    </div>
<?php }} ?>

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
