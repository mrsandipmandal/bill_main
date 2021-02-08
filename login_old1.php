<?PHP
require_once("include.class.php");
if(isset($_POST["username"]) )
{
$rememberMe="";	
$username1 = $_POST["username"];
$password1 = md5($_POST["password"]);

$SIP=$_SERVER ['REMOTE_ADDR'];
$dttm=date('Y-m-d H:i:s A');
if(isset($_POST["rememberMe"]))
{
$rememberMe = $_POST["rememberMe"];
}
$SIP=$_SERVER [ 'REMOTE_ADDR' ];	
if ($rememberMe == "rememberMe"){
	$rememberMe = "1";
}else{

	$rememberMe = "0";
}

$test  = new Init_Table();
$test->set_table("main_signup","username");
$test->username = $username1;		
$test->find();
if($test->variables!="")
{
if ($test->actnum == "0"){	
if ($test->numloginfail <= 5){	
if ($test->pass == $password1){	

$test->set_table("main_signup","username");
$test->username = $username1;
$test->lastlogin = date('Y-m-d H:i:s A');
$test->numloginfail = '0';
$test->Save();
session_start();
session_unset();
$_SESSION["pass"] = $password1;
$_SESSION["id"] = $username1;	
$_SESSION["lastlog"] = date('Y-m-d H:i:s A');

$test->set_table("main_log","sl");
$test->username = $username1;
$test->ip = $SIP;
$test->intime = $dttm;
$test->laccessed = $dttm;
$test->Create();
if($rememberMe=="1")
{
setcookie("rememberCookieUname",$username1,(time()+604800));
setcookie("rememberCookiePassword",md5($password1),(time()+604800));
}
header("Location: index.php");
	
	
}
else
{
    ?>
<script>
	alert("Password Missmatched !");
	window.document.location="login.php";
	</script>	
	<?php

}		
}
else
{

    ?>
<script>
	alert("Account Under Attack !");
	window.document.location="login.php";
	</script>	
	<?php

}		
}
else
{

    ?>
<script>
	alert("Account Not Activated !");
	window.document.location="login.php";
	</script>	
	<?php

}	
	
}
else
{
    ?>
<script>
	alert("User ID Invalid !");
	window.document.location="login.php";
	</script>	
	<?php


}

	
}
else
{
	$cdtl  = new Init_Table();
		$cdtl->set_table("main_cname","sl");
		$cdtl->sl = "1";	
		$cdtl->find();	
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>E-Go</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">
    
    <style>
		.bg {
  /* The image used
  background-image: url("assets/img/INDo420c.jpg"); */
   
  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
	</style>

</head>
<body id="top" class="bg">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Login 14 start -->
<div class="login-14">
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-5 col-md-12 bg-img none-992 align-self-center">
          
            </div>
            <div class="col-lg-7 col-md-12 bg-color-16 align-self-center">
                <div class="form-section">
                    <div class="logo-2 clearfix">
                        <a href="">
                         
                        </a>
                    </div>
                    <h3>Sign into your account</h3>
                    <div class="login-inner-form">
                        <form action="login.php" method="POST">
                            <div class="form-group form-box">
                                <input type="text" name="username" class="input-text" placeholder="User Name">
                                <i class="flaticon-mail-2"></i>
                            </div>
                            <div class="form-group form-box">
                                <input type="password" name="password" class="input-text" placeholder="Password">
                                <i class="flaticon-password"></i>
                            </div>
                            <div class="checkbox clearfix">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" name="rememberMe" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <a href="forgot.php">Forgot Password</a>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md btn-theme btn-block">Login</button>
                            </div>
                            <p class="text">Developed by<a href="http://www.onnetsolution.com" target="_blank"> Onnet Solution Infotech Pvt. Ltd.</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 14 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-2.2.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Custom JS Script -->
</body>
</html>
<?php
}
?>