<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}
date_default_timezone_set('Asia/Kolkata');
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('d-M-Y h:i:s A');
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];

$_POST['dt']=date('Y-m-d',strtotime($_POST['dt']));

if($_POST['drcr']=='-1')
{
$_POST['dldgr']='-1';
$_POST['cldgr']=$_POST['ldgr'];
}
else
{
$_POST['cldgr']='-1';
$_POST['dldgr']=$_POST['ldgr'];
}
$_POST['vno']=date('Ymdhis');
$msg="";

if($msg=="")
{
$exception=array('submit_form','table_name','page_name','drcr','ldgr');
$field=array_except($_POST,$exception);
//print_r($_POST);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table($tbl_nm,"sl");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}

		if($_POST["sl"]=='')
		{
	$pdo_obj->create();
		}
		else
		{
			$pdo_obj->save();	
		}

   $msg="Data Submited Successfully...";

 
?>
	
<script>
alert("<?php echo $msg;?>");
window.document.location="<?php echo $page_name;?>";
</script>
<?php 
}
else
{
?>
<script>
alert("<?php echo $msg;?>");
history.go(-1);
</script>
<?php	
}

?>
