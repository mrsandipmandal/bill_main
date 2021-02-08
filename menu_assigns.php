<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(0);

$user=$_POST['user'];

$ucount=count($user);
$sl=$_POST['sl'];

$adtl  = new Init_Table();
$adtl->set_table("main_menu","sl");
if($ucount==0  or $sl=="")
{
	?>
	<script>
	alert("Please Fill All The Field");
	history.go(-1);
	</script>
	<?php
}
else
{
	$user1=implode(',',$user);
	$adtl->user=$user1;
    $adtl->isall='1';
	$adtl->sl=$sl;
	$adtl->save();
	?>
	<script>
	alert("Assign Completed.");
	document.location="menu_setup.php";
	</script>
	<?php
}
