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
$_POST["eby"]=$Members->User_Details->username;
date_default_timezone_set('Asia/Kolkata');
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('d-M-Y h:i:s A');
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];

if($_POST["sl"]!='')
{
	$fld['sl']=$_POST['sl'];
	$op['sl']="!=, and";	
}

$fld['bcd']=$_POST['bcd'];
$op['bcd']="=, and";

$fld['pan']=$_POST['pan'];
$op['pan']="=,";

$list  = new Init_Table();
$list->set_table($tbl_nm,"sl");
$count=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));
$msg="";
if($count>0)	
{
$msg="PAN NO. ALREADY ENTERED WITH DIFFERENT NAME !";	
}	

if($msg=="")
{
	

$exception=array('submit_form','table_name','page_name');
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
