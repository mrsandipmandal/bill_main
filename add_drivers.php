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
$_REQUEST["eby"]=$Members->User_Details->username;
date_default_timezone_set('Asia/Kolkata');
$_REQUEST["edt"]=date('Y-m-d');
$_REQUEST["edtm"]=date('d-M-Y h:i:s A');
$tbl_nm='main_driver';
$page_name="NA";

$_REQUEST["nm"]=rawurldecode($_REQUEST["nm"]);
$_REQUEST["mob"]=rawurldecode($_REQUEST["mob"]);
$_REQUEST["licno"]=rawurldecode($_REQUEST["licno"]);

$fld['nm']=$_REQUEST['nm'];
$op['nm']="=,";

$list  = new Init_Table();
$list->set_table($tbl_nm,"sl");
$count=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));
$msg="";
if($count>0)	
{
$msg="Data Already Exists!";	
}	

if($msg=="")
{

$exception=array('submit_form','table_name','page_name','pnm');
$field=array_except($_REQUEST,$exception);
//print_r($_POST);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table($tbl_nm,"sl");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}

	$sl=$pdo_obj->create();


   $msg="Data Submited Successfully...";


?>
	
<script>
$('#compose-modal').modal('hide');
$('#dr_nm').append('<option value="<?=$sl;?>"><?=$_REQUEST['nm'];?> </option>');
$('#dr_nm').trigger('chosen:updated');
document.getElementById('dr_nm').value='<?=$sl;?>';
$('#dr_nm').trigger('chosen:updated');
add_driver();

</script>
<?php 
}
else
{
?>
<script>
alert("<?php echo $msg;?>");
</script>
<?php	
}

?>
