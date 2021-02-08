<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$grpnm="";

if(isset($_REQUEST['pnm']))
{
$page_title=base64_decode($_REQUEST['pnm']);
}
else
{
	$page_title="Dashboard";
}
if(isset($allowChangePassword))
{
	
}else{
$allowChangePassword="";	
}

if(isset($disabledFeatures))
{
	
}else{
$disabledFeatures="";	
}

date_default_timezone_set('Asia/Kolkata');
$cy=date('Y');



include "header.php";
?>

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $Members->User_Details->name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
	  <?php echo include "left_bar.php";?>
    </section>
    <!-- /.sidebar -->
  </aside>




<div class="container-fluid">
<div class="row-fluid">	
<!-- left menu starts -->

<!-- left menu ends -->
<?php
// check if the admin alows this feature: the $allowChangePassword variable is set in config.php
if ($allowChangePassword == false){die($disabledFeatures);}

//retrieve the post vars.
$oldpass1 = $HTTP_POST_VARS["oldpass"];
$password1 = $HTTP_POST_VARS["password"];
$password2 = $HTTP_POST_VARS["password2"];

//check if the password match and if there not empty
if ($password1 == $password2 && $password1 <> ""){
	//(re)check the database to see it the old password is correct
	
	        	$fld1['username']='$HTTP_SESSION_VARS[id]';
				$op1['username']="=,"; 
                $fld1['password']='$oldpass1';
				$op1['password']="="; 				

				$list1  = new Init_Table();
				$list1->set_table("signup","username");
				$cnt=$list1->row_count_custom($fld1,$op1,'','');
	
	
	
	

	if ($cnt >'0'){ 
		//update the password in the database
		
	
		$_POST2["password"]=$password1;
		$_POST2["username"]=$HTTP_SESSION_VARS[id];
		
		$field2=array_except($_POST2);
		$pdo_obj2  = new Init_Table();
		$pdo_obj2->set_table('signup',"username");
		foreach($field2 as $key=>$vl)
		{
		$pdo_obj2->$key=$vl;	
		}	
			
			
			$pdo_obj2->save();
			
		

		//update the password in the session so you don't have to logoff
		$HTTP_SESSION_VARS["pass"] = $password1;
		//echo an confirm.
		//echo "Your password was changed ";
         ?>
				<div class="alert alert-Success span10">
					<h4 class="alert-heading">Success</h4>
					<p class="Success"> <?php echo "Your password was changed ";?></p>
				</div>
<script>
alert("Your password was changed ");
setTimeout("location.href = 'logoff.php';", 500);
</script>				
		<?php
	
	
	
	}
	
	else{
		//it the check on the old password returns that it is incorrect we return that here.
		makeform("Your old password is not correct. pleast try again");
	}
	

}
else{
//if there is no match between the 2 passwords, or if the are empty,
//check if it isn't the pageload (then the password is empty and empty = incorrect)
//if not empty it calls the function makeform() with the errormessage as argument
if ($password1 == ""){makeform("");}
else{makeform("You password do not match try again.");}
}
//this function will make the change password page and put the error argument in it
function makeform($errormessage){
            if($errormessage!="")
            {
                ?>
<script>
alert("<?php echo $errormessage;?>");
//setTimeout("location.href = 'logoff.php';", 500);
</script>	

			<?php
            }
            ?>

			
			<div id="content" class="span10">
			<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#"><?php echo $page_title;?></a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">
				<div class="box span6 center">
					<div class="box-header well">
						<h2><i class="icon-user"></i><?php echo $page_title;?></h2>
						<div class="box-icon">
						
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						
					<form class="form-horizontal" method="post" action="profile.php">
							<fieldset>
                            <legend><small>Change Password</small></legend>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Old Password</label>
								<div class="controls">
								  <input class="input-xlarge" id="oldpass" type="password" value="" name="oldpass">
								</div>
                              </div>
                              <div class="control-group">
								<label class="control-label" for="password">New Password</label>
								<div class="controls">
								  <input class="input-xlarge" id="password" type="password" value="" name="password">
								</div>
                              </div>
                              <div class="control-group">
								<label class="control-label" for="password2">Confirm Password</label>
								<div class="controls">
								  <input class="input-xlarge" id="password2" type="password" value="" name="password2">
								</div>
                              </div>
                              <div class="form-actions">
								<button type="submit" class="btn btn-primary">Change Password</button>
							  </div>
							</fieldset>
						  </form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
		<hr>
		<div class="modal hide fade" id="myModal">
			<div class="box-header well" data-original-title>
						<h2><i class="icon-upload"></i> Details Report</h2>
						<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round" data-dismiss="modal"><i class="icon-remove"></i></a>
						</div>
					</div>
			<div class="modal-body">
				<p>No Data Available...</p>
			</div>
		</div>
<footer>
	<!--<p class="pull-left">&copy; <a href="http://nadiazillaparishad.in"><?=$college_name;?></a> <?=$cy;?></p> -->
	<p class="pull-right">Developed by: <a href="http://onnetsolution.com" target="_blank">Onnet Solution</a></p>
</footer>
</div><!--/.fluid-container-->
</body>
</html>
<?php
}
?>
