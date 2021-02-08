<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(0);
$eby=$_POST["eby"]=$Members->User_Details->username;


	$sl=0;
	
	$pass = $_POST['oldpass'];
	$npass1 = $_POST['password'];
	$pass2 = md5($_POST['password']);
	$npass2 = $_POST['password2'];
	
	
	if($pass=='' or $npass1=='' or $npass2=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.location.assign('profile.php');
</script>
<?php	}
	else
	{
		
		$fld['username']=$eby;
		$op['username']="=, and";
		$fld['password']=$pass;
		$op['password']="=,";
		$list  = new Init_Table();
		$list->set_table('main_signup',"sl");
		$count=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));
		$group=$list->search_custom($fld,$op,'',array('sl' => 'ASC'));
	
		  foreach($group as $key=>$ptp)
        {
          $sl=$ptp['sl'];
		}
	if($count==0)
	{
	?>
<script language="javascript">
alert('Old Password Is Incorrect.');
window.location.assign('profile.php');
</script>
<?php }
	else
	{
	if($npass1!=$npass2)
{
	?>
<script language="javascript">
alert('New Password Mismatched.');
window.location.assign('profile.php');
</script>
<?php }
else
{
	
	
	$adtl  = new Init_Table();
$adtl->set_table("main_signup","sl");
	$adtl->password=$npass1;
	$adtl->pass=$pass2;
	
$adtl->sl=$sl;
$adtl->save();
	///print_r($adtl);
	

?>
<script language="javascript">
alert('Password Change Successfully. Thank You...');
document.location = "logoff.php";
</script>
<?php
}}}


