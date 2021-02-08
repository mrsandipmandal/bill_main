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

$fld['bcd']=$_POST['bcd'];
$op['bcd']="=, and";
$fld['trkno']=$_POST['trkno'];
$op['trkno']="=,";

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
	

$exception=array('submit_form','table_name','page_name','panf','tdsf','rcf','dmob','licno');
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
		$_POST["sl"]=$pdo_obj->create();
		}
		else
		{
			$pdo_obj->save();	
		}
	$path="doc";
	if(!is_dir($path)){mkdir($path);}
	if(isset($_FILES['panf']))
	{
	$file_name=$_POST["sl"]."_panf_".date('ymdhis').uniqid();	
	$exe = pathinfo($_FILES['panf']['name'], PATHINFO_EXTENSION);
	$panf=$path."/".$file_name.".".$exe;
	if($exe!='')
	{
	move_uploaded_file($_FILES['panf']['tmp_name'], $panf);
	$pdo_obj->panf=$panf;
	}
	} 
	if(isset($_FILES['tdsf']))
	{
	$file_name=$_POST["sl"]."_tdsf_".date('ymdhis').uniqid();	
	$exe = pathinfo($_FILES['tdsf']['name'], PATHINFO_EXTENSION);
	$tdsf=$path."/".$file_name.".".$exe;
	if($exe!='')
	{
	move_uploaded_file($_FILES['tdsf']['tmp_name'], $tdsf);
	$pdo_obj->tdsf=$tdsf;
	}
	}
	if(isset($_FILES['rcf']))
	{
	$file_name=$_POST["sl"]."_rcf_".date('ymdhis').uniqid();	
	$exe = pathinfo($_FILES['rcf']['name'], PATHINFO_EXTENSION);
	$rcf=$path."/".$file_name.".".$exe;
	if($exe!='')
	{
	move_uploaded_file($_FILES['rcf']['tmp_name'], $rcf);
	$pdo_obj->rcf=$rcf;
	}
	}
	if($_POST["sl"]!='')
	{
		$pdo_obj->sl=$_POST["sl"];	
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
