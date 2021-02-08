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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>|| Subhshree ||</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 intro-section">
          <div class="brand-wrapper">
            <img src="assets\images\logo.png" alt="" class="logo">
          </div>
          <div class="intro-content-wrapper">
            <h1 class="intro-title">Welcome to Subhshree !</h1>
            <p class="intro-text">Subhshree Group is a pioneer in the field of Cement Logistics for over two decades, providing efficient, innovative, and customized solutions to a discerning list of clients across Southern, Eastern, and North-Eastern parts of India.</p>
          </div>
          <div class="intro-section-footer">
            <p>Copyright 2021  Subhshree</p>
          </div>
        </div>
        <div class="col-sm-7 form-section">
            <p class="login-wrapper-signup-text"><h3>Subhshree Group</h3></p>
          <div class="login-wrapper">
            <h2 class="login-title">Sign in</h2>
            <form action="#!" action="login.php" method="POST">
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="form-group mb-3">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="custom-control custom-checkbox login-check-box">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember Me</label>
              </div> 
              <div class="d-flex justify-content-between align-items-center mb-5">
                <input name="login" id="login" class="btn login-btn" type="submit" value="Login">
                <a href="#!" class="forgot-password-link">Password?</a>
              </div>
            </form>
            <p class="text-center txt">Developed by <a href="http://www.onnetsolution.com">Onnet Solution Infotech Pvt. Ltd.</a></p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
<?php
}
?>