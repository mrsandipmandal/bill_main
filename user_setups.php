<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('d-M-Y h:i:s A');
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];

if($_POST["sl"]!='')
{
	$fld['sl']=$_POST['sl'];
	$op['sl']="!=, and";	
}


$fld['username']=$_POST['username'];
$op['username']="=,";

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
$_POST['bcd']=implode(',', $_POST['bcd']);
$_POST['actnum']='0';
$_POST['userlevel']='10';
$_POST['password']='123';
$_POST['pass']=md5('123');
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
